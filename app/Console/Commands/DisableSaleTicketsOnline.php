<?php

namespace App\Console\Commands;

use App\Models\PerformanceCalendar;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DisableSaleTicketsOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sale:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the start time of event and close sale if it less than 40 minutes';

    protected $orderRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDateTime = Carbon::now()->addMinutes(40);

        PerformanceCalendar::where('isSoldOnline', true)
            ->where('date', '<=', $currentDateTime)
            ->update(['isSoldOnline' => false]);
    }
}
