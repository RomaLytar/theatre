<?php

namespace App\Http\Controllers\Admin;

use App\Models\Performance;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceTranslation;
use App\Transformers\CashBox\EventPosterTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Lavary\Menu\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CashBoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tickets-sold');
    }

    public function comingDates(Request $request) {
        $date = $request->input('date') ?? Carbon::now()->format('Y-m-d');
        $days = $request->input('days-count') ?? 10;

        $dates = DB::table('performance_calendars')
            ->whereDate('date', '>=', $date)
            ->where('areTicketsGenerated', true)
            ->where('isSoldInCashBox', true)
            ->orderBy('date')
            ->groupBy(DB::raw("DAY(date)"))
            ->distinct()
            ->limit($days)
            ->pluck('date');

        return response()->json([
            'status' => true,
            'dates' => $dates
        ]);
    }

    public function eventsDate(Request $request) {
        $date = $request->input('date') ?? Carbon::now()->format('Y-m-d');
        $eventId = $request->input('eventId') ?? null;

        $events = PerformanceCalendar::with([
            'tickets'            ,
            'tickets.seatPrice',
            'performance',
            'performance.translate',
            'performance.hall.translate',
        ]);
        if(!$eventId) {
            $events = $events->where('areTicketsGenerated', true)
                ->where('isSoldInCashBox', true)
                ->whereDate('date', $date)
                ->orderBy('date');
        } else {
            $events = $events->where('id', $eventId);
        }
        $events = $events->get();

        return fractal()
            ->collection($events)
            ->parseIncludes('priceZones')
            ->transformWith(new EventPosterTransformer)
            ->toArray();
    }
}
