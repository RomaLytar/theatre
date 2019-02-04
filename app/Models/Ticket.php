<?php

namespace App\Models;

use App\Models\SeatPrice;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['performance_calendar_id', 'seat_price_id', 'isAvailable', 'distributor_id', 'activated_at'];

    protected $appends = ['inReservation'];

    public function performanceCalendar() {
        return $this->belongsTo(PerformanceCalendar::class, 'performance_calendar_id');
    }

    public function seatPrice() {
        return $this->belongsTo(SeatPrice::class, 'seat_price_id');
    }

    public function distributor() {
        return $this->belongsTo(Distributor::class, 'distributor_id');
    }

    public function reservation() {
        return $this->hasOne(Reservation::class, 'ticket_id');
    }

    public function getInReservationAttribute() {
        return $this->reservationStatus();
    }

    public function reservationStatus() {
        return $this->reservation ? true : false;
    }

    public function checkAvailability() {
        return ($this->isAvailable && !$this->InReservation) ? 1 : 0;
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_tickets');
    }
}
