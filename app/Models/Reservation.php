<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'ticket_id';

    protected $fillable = ['ticket_id'];
    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'ticket_id';
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
