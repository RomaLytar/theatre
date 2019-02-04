<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Repositories\ReservationRepository;
use App\Repositories\TicketRepository;
use App\Transformers\ReservationTransformer;
use App\Transformers\TicketTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Date\Date;

class TicketController extends Controller
{
    protected $ticketRepository;
    protected $reservationRepository;

    public function __construct(TicketRepository $ticketRepository, ReservationRepository $reservationRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function ticketsInformation(Request $request) {
        $ticketIds = $request->tickets;

        $tickets = Ticket::with([
            'seatPrice',
            'seatPrice.seat',
            'seatPrice.seat.row',
            'seatPrice.seat.row.section',
            'seatPrice.seat.row.section.translate',
        ])
            ->find($ticketIds);

        return fractal()
            ->collection($tickets)
            ->parseExcludes('seatPrice')
            ->transformWith(new TicketTransformer)
            ->toArray();
    }

    public function ticketsDetails(Request $request) {
        $ticketIds = $request->tickets;

        $tickets = Ticket::with([
            'reservation',
            'seatPrice',
            'seatPrice.priceZone',
            'seatPrice.seat',
            'seatPrice.seat.media',
            'seatPrice.seat.row',
            'seatPrice.seat.row.section',
            'seatPrice.seat.row.section.translate',
            'performanceCalendar.performance',
            'performanceCalendar.performance.translate',
            'performanceCalendar.performance.hall',
            'performanceCalendar.performance.hall.translate',
            'performanceCalendar.hallPricePattern',
        ])
            ->find($ticketIds);

        return response()->json([
            'tickets' => fractal()
                ->collection($tickets)
                ->parseIncludes(['seatPrice', 'performanceCalendar', 'performanceCalendar.performance', 'performanceCalendar.hall'])
                ->transformWith(new TicketTransformer)
                ->toArray(),
        ]);
    }

    public function reservationCount(Request $request, $dateId) {
        $ticketsCount = $request->count;

        $ticketReservationIds = Reservation::pluck('ticket_id');
        $ticketIds = Ticket::where('performance_calendar_id', $dateId)
            ->where('isAvailable', true)
            ->whereNotIn('id', $ticketReservationIds)
            ->limit($ticketsCount)->pluck('id');

        if(count($ticketIds) !== $ticketsCount) {
            return response()->json([
                'status' => false,
                'message' => 'Not enough tickets',
                'count' => count($ticketIds)
            ]);
        }

        if(!$reservedTickets = $this->reservationRepository->createReservations($ticketIds)) {
            return response()->json([
                'status' => false,
                'message' => 'Tickets were not reserved'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tickets were reserved successfully',
            'reservedTickets' => fractal()
                ->collection($reservedTickets)
                ->transformWith(new ReservationTransformer)
                ->toArray()
        ]);
    }

    public function reservationTickets(Request $request) {
        $ticketIds = $request->tickets;
//        $ticketIds = [427];

        $tickets = Ticket::with('reservation')->find($ticketIds);

        if(!$this->checkTicketsAvailability($tickets)) {
            return response()->json([
                'status' => false,
                'message' => 'Some tickets are not available to buy',
                'tickets' => fractal()
                    ->collection($tickets)
                    ->parseExcludes('seatPrice')
                    ->transformWith(new TicketTransformer)
                    ->toArray()
            ]);
        }

        if(!$reservedTickets = $this->reservationRepository->createReservations($ticketIds)) {
            return response()->json([
                'status' => false,
                'message' => 'Tickets were not reserved'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tickets were reserved successfully',
            'reservedTickets' => fractal()
                ->collection($reservedTickets)
                ->transformWith(new ReservationTransformer)
                ->toArray()
        ]);
    }

    protected function checkTicketsAvailability($tickets) {
        foreach ($tickets as $ticket) {
            if(!$ticket->checkAvailability()) {
                return false;
            }
        }
        return true;
    }

    public function cancelReservationTickets(Request $request) {
        $ticketIds = $request->tickets;

        Reservation::whereIn('ticket_id', $ticketIds)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Ticket reservations has been cancelled successfully'
        ]);
    }

    public function activate($eventId, $orderId, $ticketId) {
        if(!$ticket = Order::where('status', OrderStatus::SOLD)
            ->find($orderId)
            ->tickets()
            ->where('isAvailable', false)
            ->where('performance_calendar_id', $eventId)
            ->find($ticketId)
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Такий квиток не знайдено'
            ]);
        }

        if($ticket->activated_at) {
            return response()->json([
                'status' => false,
                'message' => 'Квиток вже використано',
                'activated_at' => Date::parse($ticket->activated_at)->format('j.m.Y H:i'),
                'ticket' => fractal()
                    ->item($ticket)
                    ->parseIncludes(['seatPrice', 'performanceCalendar', 'performanceCalendar.performance', 'performanceCalendar.hall'])
                    ->transformWith(new TicketTransformer)
            ]);
        }
        $this->ticketRepository->activateTicket($ticketId);

        return response()->json([
                'status' => true,
                'message' => 'Квиток активовано',
                'activated_at' => Date::now()->format('j.m.Y H:i'),
                'ticket' => fractal()
                  ->item($ticket)
                  ->parseIncludes(['seatPrice', 'performanceCalendar', 'performanceCalendar.performance', 'performanceCalendar.hall'])
                  ->transformWith(new TicketTransformer)
                ]);
    }
}
