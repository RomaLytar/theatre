<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscription;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Session;

class SubscribeController extends Controller
{
  protected $subscriptionRepository;

  public function __construct(SubscriptionRepository $subscriptionRepository)
  {
    $this->subscriptionRepository = $subscriptionRepository;
  }

  public function subscribe(StoreSubscription $request) {
    $data = $request->all();
    $this->subscriptionRepository->createSubscription($data);

    Session::flash('message', 'Successfully subscribed!');
  }

  public function verify($token) {
    $subs = Subscription::where('token', $token)->firstOrFail();
    $subs->token = null;
    $subs->save();

    Session::flash('success', __('email.you_successfully_confirmed_your_email'));
    return redirect(route('front.home'));
  }
}
