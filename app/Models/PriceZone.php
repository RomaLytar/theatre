<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceZone extends Model
{
    protected $fillable = ['price_pattern_id', 'color_id', 'price', 'isActive'];

    public function color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

//    public function pricePattern() {
//        return $this->belongsTo(PricePattern::class, 'price_pattern_id');
//    }
}
