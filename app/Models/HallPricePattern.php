<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\PricePattern;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallPricePattern extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'hall_id', 'price_pattern_id'];

    public function hall() {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function seats() {
        return $this->hasMany(SeatPrice::class, 'hall_price_pattern_id');
    }

    public function availableSeats() {
        return $this->hasMany(SeatPrice::class, 'hall_price_pattern_id')->where('price_zone_id', '!=', null);
    }

    public function unavailableSeats() {
        return $this->hasMany(SeatPrice::class, 'hall_price_pattern_id')->where('price_zone_id', null);
    }

    public function pricePattern() {
        return $this->belongsTo(PricePattern::class, 'price_pattern_id');
    }
}
