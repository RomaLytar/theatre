<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['tickets', 'seller', 'buyer'];

    public function transform(Order $order) {
        return [
            'id' => $order->id,
            'status' => $order->status,
            'seller' => $order->seller_id ? $order->seller->fullname() : null,
            'buyer_id' => $order->buyer_id,
            'payment_type' => $order->payment_type,
            'name' => $order->name,
            'phone' => $order->phone,
            'hash' => $order->hash,
        ];
    }

    public function includeTickets(Order $order) {
        return $this->collection($order->tickets, new TicketTransformer);
    }

    public function includeSeller(Order $order) {
        return $this->item($order->seller, new UserTransformer);
    }

    public function buyer(Order $order) {
        return $this->item($order->buyer, new UserTransformer);
    }
}