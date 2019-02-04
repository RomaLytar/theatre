<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['payment_id', 'payment_status', 'first_name', 'last_name', 'phone', 'amount', 'comment'];

    protected $appends = ['date_time'];

    public function fullName() {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getDateTimeAttribute() {
        return Carbon::parse($this->created_at)->toDateTimeString();
    }
}
