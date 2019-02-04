<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const CASH_PAYMENT = 0;
    const CARD_PAYMENT = 1;

    protected $fillable = ['status', 'seller_id', 'buyer_id', 'payment_type', 'email', 'name', 'phone', 'expires_at', 'hash'];

    public function isSold() {
        return $this->status == OrderStatus::SOLD;
    }

    public function isBooked() {
        return $this->status == OrderStatus::BOOKED;
    }

    public function isReturned() {
        return $this->status == OrderStatus::RETURNED;
    }

    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer() {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function isCashPayment() {
        return $this->payment_type == self::CASH_PAYMENT;
    }

    public function isCardPayment() {
        return $this->payment_type == self::CARD_PAYMENT;
    }

    public function tickets() {
        return $this->belongsToMany(Ticket::class, 'order_tickets');
    }

}
