<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\OrderRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteExpiredBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the time of order booking and delete it if expired';

    protected $orderRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDateTime = Carbon::now();
        $orders = Order::whereIn('status', [OrderStatus::BOOKED, OrderStatus::WAITING_FOR_PAYMENT])
            ->where('expires_at', '<=', $currentDateTime)
            ->get();

        foreach ($orders as $order) {
//            $this->orderRepository->deleteOrder($order);
            $this->orderRepository->updateOrderStatus(OrderStatus::CANCELLED, $order);
        }
    }
}
