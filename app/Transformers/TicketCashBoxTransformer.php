<?php

namespace App\Transformers;

use App\Models\Ticket;
use League\Fractal\TransformerAbstract;

class TicketCashBoxTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['seatPrice'];

    public function transform(Ticket $ticket) {
        return [
            'id' => $ticket->id,
            'isAvailable' => $ticket->checkAvailability(),
            'distributor_id' => $ticket->distributor_id,
        ];
    }

    public function includeSeatPrice(Ticket $ticket) {
        return $this->item($ticket->seatPrice, new SeatPriceTransformer);
    }
}
