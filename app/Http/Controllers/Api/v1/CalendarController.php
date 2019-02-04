<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\CalendarResource;
use App\Http\Resources\CalendarsResource;
use App\Models\PerformanceCalendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CalendarController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return CalendarsResource
   */
    public function index(Request $request)
    {
        if ((!$from = $request->query('from')) ||
            (!$to = $request->query('to'))) {
            throw new BadRequestHttpException();
        }

        $calendar = PerformanceCalendar::
          with('performance', 'performance.translate', 'actors', 'actors.actor', 'actors.actor.translate')
          ->whereBetween('date', [$from, $to])
          ->orderBy('date')
          ->get();

        return new CalendarsResource($calendar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
