<?php

namespace App\Transformers\User;

use App\Models\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    public function transform(Ticket $ticket) {
        return [
            'ticket_id' => $ticket->id,
            'event_id' => $ticket->performanceCalendar->id,
            'event_title' => $ticket->performanceCalendar->performance->translate->title,
            'event_date' => $ticket->performanceCalendar->getFormatDate(),
            'event_time' => $ticket->performanceCalendar->getFormatTime(),
            'hall_title' => $ticket->performanceCalendar->performance->hall->translate->title,
            'seat_number' => $ticket->seatPrice->seat->number,
            'row_number' => $ticket->seatPrice->seat->row->number,
            'section_number' => $ticket->seatPrice->seat->row->section->number,
            'section_title' => $ticket->seatPrice->seat->row->section->translate->title,
            'price' => (float)$ticket->seatPrice->priceZone->price,
        ];
    }
}
