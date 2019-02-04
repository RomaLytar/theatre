<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leftover extends Model
{
    protected $fillable = ['user_id', 'start_sum'];

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
