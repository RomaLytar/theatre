<?php

namespace App\Http\Controllers\Admin;

use App\Models\Distributor;
use App\Models\PerformanceCalendar;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Repositories\PerformanceCalendarRepository;
use App\Repositories\TicketRepository;
use App\Models\SeatPrice;
use App\Transformers\PerformanceCalendarTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Session;

class PerformanceCalendarController extends Controller
{
    protected $performanceCalendarRepository;
    protected $ticketRepository;

    public function __construct(PerformanceCalendarRepository $performanceCalendarRepository, TicketRepository $ticketRepository)
    {
        $this->middleware('permission:event-manage');

        $this->performanceCalendarRepository = $performanceCalendarRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    public function generateTickets($id) {
        if(!$performanceCalendar = PerformanceCalendar::find($id)) {
            throw new NotFoundHttpException('Екземпляр виступу не знайдено');
        }

//        $seatPrices = SeatPrice::where('hall_price_pattern_id', $performanceCalendar->hall_price_pattern_id)->get(); // Include seats without price
        $seatPrices = SeatPrice::where('hall_price_pattern_id', $performanceCalendar->hall_price_pattern_id)->where('price_zone_id', '!=', null)->get(); // Exclude seats without price

        foreach ($seatPrices as $seatPrice) {
            $data = [
                'performance_calendar_id' => $performanceCalendar->id,
                'seat_price_id' => $seatPrice->id
            ];
            $this->ticketRepository->createTicket($data);
        }
        $this->performanceCalendarRepository->ticketsWereGenerated($id);

        Session::flash('message', 'Квитки на виступ ' . $performanceCalendar->getFormatDateTime() . ' було успішно згенеровано');
        return redirect()->back();
    }

    public function manageTickets($id) {
        if(!$performanceCalendar = PerformanceCalendar::with('tickets')
            ->whereNotNull('hall_price_pattern_id')
            ->where('areTicketsGenerated', true)
            ->find($id)
        ) {
            throw new NotFoundHttpException('Екземпляр виступу не знайдено');
        }

        if($performanceCalendar->performance->hall->name === 'outdoor') {
            $distributors = Distributor::all();

            return view('admin.performance_calendars.show-simple', compact('performanceCalendar', 'distributors'));
        }

        return view('admin.performance_calendars.show', compact('performanceCalendar'));
    }

    public function getDateWithTickets($id) {
        if(!$performanceCalendar = PerformanceCalendar::with(
            'tickets',
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
            ->find($id)
        ) {
            return response()->json([
                'status' => false
            ]);
        }

        return fractal()
            ->item($performanceCalendar)
            ->parseIncludes(['hall', 'ticketsCashBox'])
            ->transformWith(new PerformanceCalendarTransformer)
            ->toArray();
    }

    public function updateDateTickets(Request $request, $id) {
        if(!$performanceCalendar = PerformanceCalendar::with('tickets')
            ->whereNotNull('hall_price_pattern_id')
            ->where('areTicketsGenerated', true)
            ->find($id)
        ) {
            return response()->json([
                'status' => false
            ]);
        }

        $data = $request->all();
        $tickets = $data['tickets'];

//        dd($tickets);

        if (!$this->checkTicketsAvailability($tickets)) {
            return response()->json([
                'status' => false,
                'message' => 'Some tickets are not available.'
            ]);
        }

        foreach ($tickets as $ticket) {
            $data = [
                'isAvailable' => $ticket['isAvailable'],
                'distributor_id' => $ticket['distributor_id']
            ];
            $this->ticketRepository->editTicket($data, $ticket['id']);
        }

        return response()->json([
            'status' => true
        ]);
    }

    public function checkTicketsAvailability(array $tickets) {
        $ticketIds = [];
        foreach ($tickets as $ticket) {
            $ticketIds[] = $ticket['id'];
        }

        $tickets = Ticket::whereIn('id', $ticketIds)->where('isAvailable', 0)->get();
        if(count($tickets)) {
            return false;
        }
        return true;
    }

    public function updateDateTicketsSimple(Request $request, $id) {
        if(!$performanceCalendar = PerformanceCalendar::with('tickets')
            ->whereNotNull('hall_price_pattern_id')
            ->where('areTicketsGenerated', true)
            ->find($id)
        ) {
            Session::flash('message', 'Щось пішло не так, повторіть спробу!');
            return redirect()->back();
        }

        $data = $request->all();

        $distributorIds = Distributor::pluck('id');

        foreach ($distributorIds as $distributorId) {
            $needTicketCount = $data['tickets_count_' . $distributorId];
            $distributorTicketIds = $this->getTicketIds($performanceCalendar->id, $distributorId);
            $distributorTicketsCount = $distributorTicketIds->count();

            if($distributorTicketsCount === 0) {  // If tickets are not booked for this distributor
                $availableTicketIds = $this->getTicketIds($performanceCalendar->id, null, true, $needTicketCount);
                $this->attachDistributor($availableTicketIds, $distributorId);
            }
            else if($distributorTicketsCount < $needTicketCount) { // If you need to reserve in addition for this distributor
                $attachTicketsCount = $needTicketCount - $distributorTicketsCount;
                $availableTicketIds = $this->getTicketIds($performanceCalendar->id, null, true, $attachTicketsCount);
                $this->attachDistributor($availableTicketIds, $distributorId);
            }
            else if($distributorTicketsCount > $needTicketCount) { // If it is necessary to remove from the reserve for this distributor
                $detachTicketsCount = $distributorTicketsCount - $needTicketCount;
                $this->detachDistributor($distributorTicketIds, $distributorId, $detachTicketsCount);
            }
        }

        Session::flash('message', 'The information is successfully updated!');
        return redirect()->back();
    }

    private function getTicketIds($performanceCalendarId, $distributorId = null, $isAvailable = false,  $limit = null) {
        $reservationTicketIds = Reservation::pluck('ticket_id');
        return Ticket::where('performance_calendar_id', $performanceCalendarId)
            ->where('distributor_id', $distributorId)
            ->where('isAvailable', $isAvailable)
            ->whereNotIn('id', $reservationTicketIds)
            ->limit($limit)
            ->pluck('id');
    }

    private function attachDistributor($ticketIds, $distributorId) {
        Ticket::whereIn('id', $ticketIds)
            ->update(['isAvailable' => false, 'distributor_id' => $distributorId]);
    }

    private function detachDistributor($ticketIds, $distributorId, $limit = null) {
        Ticket::whereIn('id', $ticketIds)
            ->where('distributor_id', $distributorId)
            ->limit($limit)
            ->update(['isAvailable' => true, 'distributor_id' => null]);
    }

    public function dropTickets($id) {
        if(!$performanceCalendar = PerformanceCalendar::find($id)) {
            throw new NotFoundHttpException('Екземпляр виступу не знайдено');
        }
        Ticket::where('performance_calendar_id', $performanceCalendar->id)->delete();
        $this->performanceCalendarRepository->ticketsWereDeleted($id);

        Session::flash('message', 'Квитки на виступ ' . $performanceCalendar->getFormatDateTime() . ' було успішно видалені');
        return redirect()->back();
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
