<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $fillable = ['email', 'token'];

  public function status() {
    $status = $this->token;

    if($status === '') {
      $status = __('email.confirmed');
    } else {
      $status = __('email.unconfirmed');
    }
    return $status;
  }

}
