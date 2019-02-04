<?php

namespace App\Transformers\User;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['tickets'];

    public function transform(Order $order) {
        return [
            'number' => $order->id,
            'status' => $order->status,
            'hash' => $order->hash,
        ];
    }

    public function includeTickets(Order $order) {
        return $this->collection($order->tickets, new TicketTransformer);
    }
}