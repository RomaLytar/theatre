<?php

namespace App\Transformers\CashBox;

use App\Models\Performance;
use App\Models\PerformanceCalendar;
use App\Transformers\TicketCashBoxTransformer;
use Lavary\Menu\Collection;
use League\Fractal\TransformerAbstract;

class EventPosterTransformer extends TransformerAbstract
{
    public function transform(PerformanceCalendar $event)
    {
        return [
            'id' => $event->id,
            'title' => $event->performance->translate->title,
            'date' => $event->getFormatDate(),
            'time' => $event->getFormatTime(),
            'hall' => $event->performance->hall->translate->title,
            'seats_count' => $event->tickets->count(),
            'seats_available' => $event->tickets->where('isAvailable', true)->count(),
            'seats_booked' => $event->tickets->where('distributor_id', '!=', null)->count(),
            'seats_sold' => $event->tickets->where('distributor_id', null)->where('isAvailable', false)->count(),
            'priceZones' => $this->priceZones($event)
        ];
    }

    protected function priceZones($event) {
        $priceZones = $event->hallPricePattern->pricePattern->priceZones;
        $priceZonesArr = [];
        foreach ($priceZones as $priceZone) {
            $priceZonesArr[$priceZone->id] = new Collection();
            $priceZonesArr[$priceZone->id]['title'] = $priceZone->color->title;
            $priceZonesArr[$priceZone->id]['color'] = $priceZone->color->code;
            $priceZonesArr[$priceZone->id]['price'] = $priceZone->price;
            $priceZonesArr[$priceZone->id]['seats_count'] = 0;
        }

        $tickets = $event->tickets->where('isAvailable', true);
        foreach ($tickets as $ticket) {
            $priceZone = $ticket->seatPrice->price_zone_id;
            $priceZonesArr[$priceZone]['seats_count'] += 1;
        }
        return $priceZonesArr;
    }
}
