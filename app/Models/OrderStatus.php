<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    const WAITING_FOR_PAYMENT = 'waiting_for_payment';
    const SOLD = 'sold';
    const BOOKED = 'booked';
    const RETURNED = 'returned';
    const CANCELLED = 'cancelled';
}
