<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\{UserRegisterRequest, UserLoginRequest, UserUpdateRequest};
use App\Mail\ActivateAccount;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Transformers\User\OrderTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $auth;

    protected $userRepository;
    protected $subscriptionRepository;

    public function __construct(JWTAuth $auth, UserRepository $userRepository, SubscriptionRepository $subscriptionRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function login(UserLoginRequest $request)
    {
        try {
            if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'errors' => [
                    'root' => 'Failed.'
                ]
            ], $e->getStatusCode());
        }

        return response()->json([
            'data' => $request->user(),
            'meta' => [
                'token' => $token
            ]
        ], 200);
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->all();

        $user = $this->userRepository->createUser($data);

        if($data['subscription_status'] === true) {
            $this->subscriptionRepository->createSubscription($data);
        }

        \Mail::to($user)->send(new ActivateAccount($user));

        return response()->json([
            'data' => [
                'user_id' => $user->id
            ]
        ], 200);
    }

    public function activation(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'token' => 'required',
        ]);
        $user = User::findOrFail($request->user_id);

        if (!$user->confirmed && $request->token === md5($user->email)) {
            $user->confirmed = true;
            $user->update();
            $user->assignRole('user');
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Your account was activated before'
            ], 401);
        }

        return response()->json([
            'status' => true
        ], 200);
    }

    public function logout()
    {
        $this->auth->invalidate($this->auth->getToken());

        return response(null, 200);
    }

    public function user(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    public function updateUser(UserUpdateRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        $status = $this->userRepository->editUser($data, $user);

        if($status === 'incorrect_password') {
            return response()->json([
                'status' => false,
                'message' => __('messages.your_old_password_is_incorrect')
            ], 404);
        }

        return response()->json([
            'data' => User::find($user->id),
        ], 200);
    }

    public function tickets(Request $request) {
        $userId = $request->user()->id;
        $with = $request->input('with') ?? 'active';
        $dateFrom = Carbon::now();
        $dateTo = $dateFrom->format('Y-m-d');
        if ($with === 'overdue') {
            $dateFrom = $dateFrom->subDays(30);
        }
        $dateFrom = $dateFrom->format('Y-m-d');

        if(!$orders = Order::with([
            'tickets',
            'tickets.seatPrice',
            'tickets.seatPrice.seat',
            'tickets.seatPrice.seat.row',
            'tickets.seatPrice.seat.row.section',
            'tickets.seatPrice.seat.row.section.translate',
            'tickets.seatPrice.priceZone',
            'tickets.performanceCalendar',
            'tickets.performanceCalendar.performance',
            'tickets.performanceCalendar.performance.translate',
            'tickets.performanceCalendar.performance.hall',
            'tickets.performanceCalendar.performance.hall.translate',
        ])
            ->whereHas('tickets.performanceCalendar', function ($query) use ($with, $dateFrom, $dateTo) {
                $query->whereDate('date', '>=', $dateFrom);
                if ($with === 'overdue') {
                    $query->whereDate('date', '<', $dateTo);
                }
            })
            ->where('buyer_id', $userId)
            ->where('status', OrderStatus::SOLD)
            ->get()) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        return fractal()
            ->collection($orders)
            ->parseIncludes(['tickets'])
            ->transformWith(new OrderTransformer);
    }
}
