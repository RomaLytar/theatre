<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    protected $fillable = ['number'];

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function seats() {
        return $this->hasMany(Seat::class, 'row_id');
    }
}
