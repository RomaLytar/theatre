<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricePattern extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title'];

    public function priceZones() {
        return $this->hasMany(PriceZone::class, 'price_pattern_id')->where('isActive', true);
    }

    public function priceZonesAll() {
        return $this->hasMany(PriceZone::class, 'price_pattern_id');
    }

    public function hallPricePatterns() {
        return $this->hasMany(HallPricePattern::class, 'price_pattern_id');
    }
}
