<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Encounter;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
{
    // Schedule the task to run every hour
    $schedule->call(function () {
        Encounter::where('created_at', '<=', now()->subHour())
            ->where('status', STATUS_IN_PROGRESS)
            ->whereNull('arrived_at')
            ->update(['status' => STATUS_MISSED]);
    })->hourly();
}

//   0 * * * * cd /var/www/html/ju-sis && php artisan schedule:run >> /dev/null 2>&1
//   */30 * * * * cd /var/www/html/ju-sis && php artisan schedule:run >> /dev/null 2>&1


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
