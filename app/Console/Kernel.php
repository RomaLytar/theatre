<?php

namespace App\Console;

use App\Console\Commands\DeleteExpiredBooking;
use App\Console\Commands\DeleteExpiredReservations;
use App\Console\Commands\DisableSaleTicketsOnline;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DeleteExpiredBooking::class,
        DeleteExpiredReservations::class,
        DisableSaleTicketsOnline::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reservation:update')
            ->everyMinute();
        $schedule->command('booking:delete')
            ->everyMinute();
        $schedule->command('sale:disable')
            ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
