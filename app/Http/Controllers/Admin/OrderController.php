<?php

namespace App\Http\Controllers\Admin;

use App\Models\Distributor;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Ticket;
use App\Repositories\OrderRepository;
use App\Repositories\TicketRepository;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $ticketRepository;

    public function __construct(OrderRepository $orderRepository, TicketRepository $ticketRepository)
    {
        $this->middleware('permission:tickets-sold');

        $this->orderRepository = $orderRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function create(Request $request) {
        $data = $request->all();

        if(!$this->checkTicketsAvailability($data['tickets'])) {
            return response()->json([
                'status' => false,
                'message' => 'Some tickets are not available to buy',
            ]);
        }

        $order = $this->orderRepository->createOrderInCashBox($data);

        $order = Order::with([
          'tickets'
        ])->find($order->id);

        return response()->json([
            'status' => true,
            'message' => 'You have bought tickets successfully',
            'order' => fractal()
                ->item($order)
                ->parseIncludes(['tickets'])
                ->transformWith(new OrderTransformer)
        ]);
    }

    public function createForDistributor(Request $request) {
        $data = $request->all();

        if(!$this->checkDistributor($data['tickets'], $data['distributor_id'])) {
            return response()->json([
                'status' => false,
                'message' => 'Some tickets are not available to buy',
            ]);
        }

        $distributor = Distributor::find($data['distributor_id']);
        $data['buyer_id'] = $distributor->user_id;

        $order = $this->orderRepository->createOrderInCashBox($data);

        $this->deleteDistributorFromTicket($data['tickets']);

        return response()->json([
            'status' => true,
            'message' => 'You have bought tickets successfully',
            'order' => fractal()
                ->item($order)
                ->parseIncludes(['tickets'])
                ->transformWith(new OrderTransformer)
        ]);
    }

    public function checkTicketsAvailability(array $ticketIds) {
        $tickets = Ticket::whereIn('id', $ticketIds)->where('isAvailable', 0)->get();
        if(count($tickets)) {
            return false;
        }
        return true;
    }

    protected function checkDistributor(array $ticketIds, $distributorId) {
        $tickets = Ticket::whereIn('id', $ticketIds)->where('distributor_id', '!=', $distributorId)->get();
        if(count($tickets)) {
            return false;
        }
        return true;
    }

    protected function deleteDistributorFromTicket($ticketIds) {
        Ticket::whereIn('id', $ticketIds)->update(['distributor_id' => null]);
    }

    public function search(Request $request) {
        $attributeName = $request->input('param');
        $orderStatus = $request->input('status');
        $query = $request->input('query');

        $orders = Order::where('status', $orderStatus)
            ->where('seller_id', '!=', null);
        if($attributeName === 'name') {
            $orders = $orders->where($attributeName, 'LIKE', '%' . $query . '%');
        } else {
            $orders = $orders->where($attributeName, $query);
        }

        $orders = $orders->get();

        return fractal()
            ->collection($orders)
            ->parseIncludes(['tickets', 'tickets.seatPrice', 'tickets.performanceCalendar', 'tickets.performanceCalendar.performance', 'tickets.performanceCalendar.hall'])
            ->transformWith(new OrderTransformer);
    }

    public function return(Request $request, $orderId) {
        if(!$order = Order::find($orderId)
        ) {
            return response()->json([
                'status' => false,
                'message' => 'No order found'
            ]);
        }

        if(!$ticketIds = $request->input('tickets')) {
            $this->orderRepository->updateOrderStatus(OrderStatus::RETURNED, $order);
            $message = 'The order was returned';
        } else {
            $this->orderRepository->returnTickets($ticketIds, $order);
            $message = 'The tickets were returned';
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function confirm(Request $request, $orderId) {
        if(!$order = Order::find($orderId)
        ) {
            return response()->json([
                'status' => false,
                'message' => 'No order found'
            ]);
        }

        $params = [];
        $params['payment_type'] = $request->input('payment_type');
        $params['status'] = OrderStatus::SOLD;
        $this->orderRepository->updateOrder($params, $order);

        $order = Order::find($order->id);

        return response()->json([
            'status' => true,
            'message' => 'The order was confirmed',
            'order' => fractal()
                ->item($order)
                ->parseIncludes(['tickets'])
                ->transformWith(new OrderTransformer)
        ]);
    }

    public function deleteBooking($orderId) {
        if(!$order = Order::where('status', OrderStatus::BOOKED)
            ->find($orderId)
        ) {
            return response()->json([
                'status' => false,
                'message' => 'No reservation found'
            ]);
        }

        $this->orderRepository->deleteOrder($order);

        return response()->json([
            'status' => true,
            'message' => 'The reservation has been successfully cancelled'
        ]);
    }

    public function getPerDay(Request $request) {
        $date = $request->input('date') ?? Carbon::today()->format('Y-m-d');
        $eventId = $request->input('eventId');

        $orders = Order::with([
            'tickets',
            'tickets.performanceCalendar',
            'tickets.performanceCalendar.performance',
            'tickets.performanceCalendar.performance.translate',
            'tickets.seatPrice',
            'tickets.seatPrice.seat',
            'tickets.seatPrice.seat.row',
            'tickets.seatPrice.seat.row.section',
            'tickets.seatPrice.seat.row.section.hall',
            'tickets.seatPrice.seat.row.section.translate',
            'tickets.seatPrice.seat.row.section.hall.translate',
            'tickets.seatPrice.priceZone'
        ])->where('seller_id', \Auth::user()->id)
            ->where('status', OrderStatus::SOLD)
            ->whereDate('created_at', $date);
        if($eventId != null) {
            $orders = $orders->whereHas('tickets', function ($query) use($eventId) {
                $query->where('performance_calendar_id', $eventId);
            });
        }
        $orders = $orders->latest()->get();

        return fractal()
            ->collection($orders)
            ->parseIncludes(['tickets', 'tickets.performanceCalendar', 'tickets.performanceCalendar.performance', 'tickets.performanceCalendar.hall', 'tickets.seatPrice'])
            ->transformWith(new OrderTransformer)
            ->toArray();
    }
}
