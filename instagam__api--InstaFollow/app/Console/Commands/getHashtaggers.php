<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\autoController;

class getHashtaggers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:getTaggers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will start processing all of the Hashtags for those users.';

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
        // Get all hashtags.
        app('App\Http\Controllers\autoController')->auto_process_hashtag_feed();

        return;
    }
}
