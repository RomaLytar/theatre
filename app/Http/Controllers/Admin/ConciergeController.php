<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerformanceCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ConciergeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ticket-activation');
    }

    public function index() {
        $currentDateTime = Carbon::now()->subHours(4);
        $currentDate = Carbon::now()->format('Y-m-d');
        $events = PerformanceCalendar::with([
            'performance',
            'performance.translate',
            'performance.hall',
            'performance.hall.translate',
        ])
            ->where('areTicketsGenerated', true)
            ->where('date', '>=', $currentDateTime)
            ->whereDate('date', '=', $currentDate)
            ->get();

        return view('admin.concierge.index', compact('events'));
    }
}
