<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // fdi-validation scheduled job
        $schedule->command('pms:fdi-validation')
            ->daily()
            ->name("Scheduled Job - FDI Validation!")
            ->emailOutputTo('dev@reformedtech.org')
            ->emailOutputOnFailure('dev@reformedtech.org');

        // parking-pass-validation
        $schedule->command('pms:parking-pass-validation')
            ->everyMinute()
            ->name("Scheduled Job - Parking Pass Validation!");

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
