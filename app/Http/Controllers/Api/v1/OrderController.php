<?php

namespace App\Http\Controllers\Api\v1;

use App\Mail\OrderCreated;
use App\Models\LiqPay;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Ticket;
use App\Repositories\OrderRepository;
use App\Transformers\OrderTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrderOnline(Request $request) {
        $data = $request->all();

        if(!$this->checkTicketsAvailability($data['tickets'])) {
            return response()->json([
                'status' => false,
                'message' => 'Some tickets are not available to buy',
            ]);
        }

        $order = $this->orderRepository->createOrderOnline($data);
        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'order_id' => $order->id
        ]);
    }

    public function checkTicketsAvailability(array $ticketIds) {
        $tickets = Ticket::whereIn('id', $ticketIds)->where('isAvailable', 0)->get();
        if(count($tickets)) {
            return false;
        }
        return true;
    }

    public function formOrder($orderId) {
        $order = Order::with(
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
        )->where('status', OrderStatus::SOLD)->find($orderId);

        return $order;
    }

    public function formPdf(Request $request, $orderHash) {
        if(!$order = Order::where('hash', $orderHash)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'No order found'
            ]);
        }

        if(!$ticketId = $request->input('ticket')) {
            $pdf = \PDF::loadView('pdf.tickets', ['order' => $order]);
            $pdfTitle = 'order' . $order->id . '.pdf';
        } else {
            $ticket = $order->tickets()->find($ticketId);
            $pdf = \PDF::loadView('pdf.ticket', ['ticket' => $ticket, 'order' => $order]);
            $pdfTitle = 'ticket' . $ticket->id . '.pdf';
        }

        return $pdf->download($pdfTitle);
    }

    public function generatePaymentCode(Request $request) {
        $orderId = $request->input('order_id') ?? 0;

        if(!$order = Order::with([
            'tickets',
            'tickets.seatPrice',
            'tickets.seatPrice.priceZone'
        ])->where('status', OrderStatus::WAITING_FOR_PAYMENT)
            ->find($orderId)) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ]);
        }

        $language = $request->input('lang');
        $orderSum = $this->performOrderSum($order);
        $publicKey = env('LIQ_PAY_PUBLIC_KEY');
        $privateKey = env('LIQ_PAY_PRIVATE_KEY');

        $liqPay = new LiqPay($publicKey, $privateKey);
        $liqPayParams = $liqPay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $orderSum,
            'currency'       => 'UAH',
            'description'    => 'Придбання квитків',
            'expired_date'   => Carbon::parse($order->expires_at)->toDateTimeString(),
            'server_url'     => route('api.v1.orders.update'),
            'result_url'     => route('front.ticket.index') . '/payment-check',
            'language'       => $language,
            'order_id'       => $orderId,
            'version'        => '3',
            'sandbox'        => env('LIQ_PAY_SANDBOX')
        ));

        return response()->json([
            'status' => true,
            'data' => [
                $liqPayParams,
            ]
        ]);
    }

    private function performOrderSum($order) {
        $orderSum = 0;
        foreach ($order->tickets as $ticket) {
            $orderSum += $ticket->seatPrice->priceZone->price;
        }

        return $orderSum;
    }

    public function updateStatus(Request $request) {
        $data = $request->input('data');
        $responseSignature = $request->input('signature');
        $publicKey = env('LIQ_PAY_PUBLIC_KEY');
        $privateKey = env('LIQ_PAY_PRIVATE_KEY');

        $sign = base64_encode( sha1(
            $privateKey .
            $data .
            $privateKey
            , 1 ));

        if(!$sign === $responseSignature) {
            return response()->json([
                'status' => false
            ]);
        }

        $liqPay = new LiqPay($publicKey, $privateKey);
        $data = $liqPay->decode_params($data);
        $paymentStatus = $data['status'];
        $orderId = $data['order_id'];

        $needPaymentStatus = env('LIQ_PAY_SANDBOX') === true ? 'sandbox' : 'success';

        if($paymentStatus === $needPaymentStatus
            && $order = Order::where('status', OrderStatus::WAITING_FOR_PAYMENT)->find($orderId)) {
            $this->orderRepository->updateOrderStatus(OrderStatus::SOLD, $order);
            $userEmail = $order->user->email ?? $order->email;
            \Mail::to($userEmail)->send(new OrderCreated($order));
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function details(Request $request) {
        $orderId = $request->input('order_id');

        if(!$order = $this->formOrder($orderId)) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found. Please try again',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'You have bought tickets successfully',
            'order' => fractal()
                ->item($order)
                ->parseIncludes(['tickets'])
                ->transformWith(new OrderTransformer)
        ]);
    }
}
