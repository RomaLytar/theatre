<?php

namespace App\Http\Controllers;

use App\Models\PerformanceCalendar;
use App\Models\Hall;
use App\Models\PerformanceType;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index() {
      $performancesType = PerformanceType::with('translate')->distinct('name')->get();
      $performancesHall = Hall::with('translate')->distinct('name')->get();

      $calendar = PerformanceCalendar::whereDate('date', '>=', date('Y m d'))->orderBy('date')->pluck('date')->groupBy(function($dates) {
        return Carbon::parse($dates)->format('n,Y');
      });
      $dates = [];
      foreach ($calendar as $date => $event) {
        $arr = explode(',', $date);
        $dates[$arr[0]] = $arr[1];
      }
      return view('pages.theatre.pages.calendar', compact('dates', 'performancesType', 'performancesHall'));
    }
}
