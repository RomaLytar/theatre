<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the time of reservation ticket and delete it if expired';

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
        $currentDateTime = Carbon::now()->subMinutes(15);
        Reservation::where('updated_at', '<=', $currentDateTime)->delete();
    }
}
