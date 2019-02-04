<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Reservation;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Crypt;

class OrderRepository extends Repository
{
    protected $ticketRepository;

    public function __construct(App $app, TicketRepository $ticketRepository)
    {
        parent::__construct($app);
        $this->ticketRepository = $ticketRepository;

    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Order::class;
    }

    public function createOrderOnline(array $data)
    {
        $ticket = Reservation::whereIn('ticket_id', $data['tickets'])->first();
        $data['expires_at'] = Carbon::parse($ticket->created_at)->addMinutes(15)->toDateTimeString();

        $order = [
            'status' => OrderStatus::WAITING_FOR_PAYMENT,
            'buyer_id' => $data['user_id'] ?? null,
            'payment_type' => Order::CARD_PAYMENT,
            'email' => $data['email'] ?? null,
            'expires_at' => $data['expires_at'] ?? null,
        ];
        $order = $this->create($order);
        $this->update(['hash' => md5($order->id)], ['id' => $order->id]);

        $this->addTicketsToOrder($data['tickets'], $order);

        return $order;
    }

    public function createOrderInCashBox(array $data)
    {
        if($data['status'] === OrderStatus::BOOKED) {
            $ticket = Ticket::find($data['tickets'][0]);
            $data['expires_at'] = Carbon::parse($ticket->performanceCalendar->date)->subMinutes(40)->format('Y-m-d H:i:s');
        }

        $order = [
            'status' => $data['status'],
            'seller_id' => $data['seller_id'] ?? null,
            'buyer_id' => $data['buyer_id'] ?? null,
            'payment_type' =>  $data['payment_type'] ?? null,
            'name' => $data['name'] ?? null,
            'phone' => $data['phone'] ?? null,
            'expires_at' => $data['expires_at'] ?? null,
        ];
        $order = $this->create($order);
        $this->update(['hash' => md5($order->id)], ['id' => $order->id]);

        $this->addTicketsToOrder($data['tickets'], $order);

        Reservation::whereIn('ticket_id', $data['tickets'])->delete();

        return $order;
    }

    public function updateOrder($params, Order $order) {
        $this->updateOrderStatus($params['status'], $order);
        $this->update(['payment_type' => $params['payment_type']], ['id' => $order->id]);
    }

    public function updateOrderStatus($status, Order $order) {
        $this->update(['status' => $status], ['id' => $order->id]);
        if($status === OrderStatus::RETURNED || $status === OrderStatus::WAITING_FOR_PAYMENT) {
            foreach ($order->tickets as $ticket) {
                $this->ticketRepository->makeAvailable($ticket->id);
            }
        }
    }

    /*
     * Here we delete ticket from order
     * Make ticket available to buy
     * And create order with status 'returned' and attach this ticket id
     */
    public function returnTickets($ticketIds, $order) {
        $order->tickets()->detach($ticketIds);

        $data = [
            'status' => OrderStatus::RETURNED,
            'tickets' => $ticketIds,
            'payment_type' =>  $order->payment_type,
        ];

        $this->createOrderInCashBox($data);
        $this->updateTicketsAvailability($ticketIds, true);
    }

    protected function addTicketsToOrder(array $ticketIds, Order $order) {
        $order->tickets()->attach($ticketIds);
        $this->updateTicketsAvailability($ticketIds);
    }

    protected function updateTicketsAvailability($ticketIds, $availabilityStatus = false) {
        Ticket::whereIn('id', $ticketIds)->update([
            'isAvailable' => $availabilityStatus
        ]);
    }

    public function deleteOrder($order)
    {
        foreach ($order->tickets as $ticket) {
            $this->ticketRepository->makeAvailable($ticket->id);
        }
        $this->delete($order->id);
    }
}
