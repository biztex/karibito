<?php

namespace App\Console;

use App\Console\Commands\PushMessages;
use App\Console\Commands\UploadCustomerSeika;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        // $schedule->command('inspire')->hourly();

//        $schedule->command('backup:clean --disable-notifications')->dailyAt('07:50');
        // $schedule->command('backup:clean')->dailyAt('07:50');
        // $schedule->command('backup:run --only-db')->dailyAt('17:00');

        // $schedule->call(function () {
        //     Log::debug('Schedulaerのテスト確認');
        // })->everyFiveMinutes();
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