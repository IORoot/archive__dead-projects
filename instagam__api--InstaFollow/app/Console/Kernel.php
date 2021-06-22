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
        Commands\ClearSpamLimits::class,
        Commands\getHashtaggers::class,
        Commands\batchProcessPeople::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // ALL TIMES ARE 1 HOUR BEHIND.
        $logfile = '/var/www/vhosts/ioroot.com/instafollow/storage/logs/instafollow.log';

        // Find new Hashtags on Mondays
        $schedule->command('process:getTaggers')
            ->cron('0 0 * * 1')->appendOutputTo($logfile);

        // Run batch process at 8am, 4pm every day.
        $schedule->exec('php /var/www/vhosts/ioroot.com/instafollow/artisan process:hitusers')
           ->cron('0 7,15 * * *')->appendOutputTo($logfile);

        // Reset all LIMITs at 7:30am, 3:30pm every day.
        $schedule->command('spam:clearlimits')
            ->cron('30 6,14 * * *')->appendOutputTo($logfile);
    
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
