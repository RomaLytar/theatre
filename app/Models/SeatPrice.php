<?php

namespace App\Models;

use App\Models\PricePattern;
use App\Models\PriceZone;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Model;

class SeatPrice extends Model
{
    protected $fillable = ['seat_id', 'hall_price_pattern_id', 'price_zone_id'];

    public function seat() {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    public function pricePattern() {
        return $this->belongsTo(PricePattern::class, 'price_pattern_id');
    }

    public function priceZone() {
        return $this->belongsTo(PriceZone::class, 'price_zone_id');
    }
}
