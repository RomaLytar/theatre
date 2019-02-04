<?php

namespace App\Transformers;

use App\Models\PerformanceCalendar;
use League\Fractal\TransformerAbstract;

class PerformanceCalendarTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['hall', 'performance', 'tickets', 'ticketsCashBox'];

    public function transform(PerformanceCalendar $performanceCalendar) {
        return [
            'id' => $performanceCalendar->id,
            'date' => $performanceCalendar->date,
            'price_pattern_id' => $performanceCalendar->hallPricePattern->price_pattern_id
        ];
    }

    public function includeHall(PerformanceCalendar $performanceCalendar) {
        return $this->item($performanceCalendar->performance->hall, new HallTransformer);
    }

    public function includeTickets(PerformanceCalendar $performanceCalendar) {
        return $this->collection($performanceCalendar->tickets, new TicketTransformer);
    }

    public function includeTicketsCashBox(PerformanceCalendar $performanceCalendar) {
        return $this->collection($performanceCalendar->tickets, new TicketCashBoxTransformer);
    }

    public function includePerformance(PerformanceCalendar $performanceCalendar) {
        return $this->item($performanceCalendar->performance, new PerformanceTransformer);
    }
}
