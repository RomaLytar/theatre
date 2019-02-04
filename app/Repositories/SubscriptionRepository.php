<?php

namespace App\Repositories;

use App\Mail\SubscribeEmail;

class SubscriptionRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Subscription';
  }

  public function createSubscription($data)
  {
    $subscription = [
      'email' => $data['email'],
      'token' => str_random(100)
    ];
    $subs = $this->create($subscription);

    \Mail::to($subs)->send(new SubscribeEmail($subs));
  }
}
