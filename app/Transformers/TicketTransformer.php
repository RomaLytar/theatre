<?php

namespace App\Transformers;

use App\Models\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['seatPrice'];
    protected $availableIncludes = ['performanceCalendar'];

    public function transform(Ticket $ticket) {
        return [
            'id' => $ticket->id,
            'isAvailable' => $ticket->checkAvailability(),
        ];
    }

    public function includeSeatPrice(Ticket $ticket) {
        return $this->item($ticket->seatPrice, new SeatPriceTransformer);
    }

    public function includePerformanceCalendar(Ticket $ticket) {
        return $this->item($ticket->performanceCalendar, new PerformanceCalendarTransformer);
    }
}
