<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\AutoDonate2AM',
        'App\Console\Commands\AutoDonate2PM',
        'App\Console\Commands\AutoDonate8AM',
        'App\Console\Commands\AutoDonate8PM'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        date_default_timezone_set("Asia/Calcutta");
        
        $schedule->command('AutoDonate2AM')
                // ->everyMinute();
                // ->everyFiveMinutes();                
                ->dailyAt('02:00');
                //->monthly();
        $schedule->command('AutoDonate8AM')                
                ->dailyAt('08:00');

        $schedule->command('AutoDonate2PM')                
                // ->dailyAt('13:25');
                ->dailyAt('14:00');

        $schedule->command('AutoDonate8PM')                
                ->dailyAt('20:00');
        
        // $schedule->call(function () {
        //     DB::table('test')->delete();
        // })->everyMinute();
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
