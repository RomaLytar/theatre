<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\PerformanceCalendar;
use App\Models\PricePattern;
use App\Transformers\PerformanceCalendarTransformer;
use App\Transformers\PricePatternTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;

class EventController extends Controller
{
    public function getTickets($id) {
        $isSoldOnline = \request('online') === true ? 'isSoldOnline' : 'isSoldInCashBox';
        if(!$performanceCalendar = PerformanceCalendar::with(
            'tickets',
            'tickets.reservation',
            'tickets.seatPrice',
            'tickets.seatPrice.priceZone',
            'tickets.seatPrice.seat',
            'tickets.seatPrice.seat.media',
            'tickets.seatPrice.seat.row',
            'tickets.seatPrice.seat.row.section',
            'tickets.seatPrice.seat.row.section.translate'
        )
            ->whereNotNull('hall_price_pattern_id')
            ->where('areTicketsGenerated', true)
            ->where($isSoldOnline, true)
            ->find($id)
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Selling tickets online for this event is not available.'
            ]);
        }

        return fractal()
            ->item($performanceCalendar)
            ->parseIncludes(['hall', 'performance', 'tickets'])
            ->transformWith(new PerformanceCalendarTransformer)
            ->toArray();
    }

    public function getPriceZones($pricePatternId)
    {
        if (!$pricePattern = PricePattern::with([
            'priceZones',
            'priceZones.color',
        ])
            ->find($pricePatternId)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        return fractal()
            ->item($pricePattern)
            ->parseIncludes(['priceZones'])
            ->transformWith(new PricePatternTransformer)
            ->toArray();
    }

    public function getAllPerformanceDates($performanceId) {
        if (!$dates = PerformanceCalendar::with([
            'hallPricePattern'
        ])
            ->where('performance_id', $performanceId)
            ->where('areTicketsGenerated', true)
            ->where('isSoldOnline', true)
            ->get()
        ) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        return fractal()
            ->collection($dates)
            ->transformWith(new PerformanceCalendarTransformer)
            ->toArray();
    }
}
