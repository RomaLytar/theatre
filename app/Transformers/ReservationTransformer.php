<?php

namespace App\Transformers;

use App\Models\Reservation;
use Illuminate\Support\Carbon;
use League\Fractal\TransformerAbstract;

class ReservationTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['ticket'];

    public function transform(Reservation $reservation) {
        return [
            'ticket_id' => $reservation->ticket_id,
            'reserved_time' => Carbon::parse($reservation->updated_at)->getTimestamp()
        ];
    }

    public function includeTicket(Reservation $reservation) {
        return $this->item($reservation->ticket, new TicketTransformer);
    }
}