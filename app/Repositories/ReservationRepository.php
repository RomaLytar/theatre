<?php

namespace App\Repositories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Reservation::class;
    }

    public function createReservation($data)
    {
        $reservation = [
            'ticket_id' => $data['ticket_id'],
        ];
        $reserveTicket = $this->create($reservation);

        return $reserveTicket;
    }

    public function createReservations($ticketIds)
    {
        $reservedTickets = new Collection();
        foreach ($ticketIds as $ticketId) {
            $data = [
                'ticket_id' => $ticketId
            ];
            $reservedTickets->push($this->createReservation($data));
        }
        return $reservedTickets;
    }

    public function editReservation($data, $id)
    {
        $array = [
            'ticket_id' => $data['ticket_id'],
        ];

        $this->update($array, ['id' => $id]);
    }
}
