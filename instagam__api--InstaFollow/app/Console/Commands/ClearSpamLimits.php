<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\instagramcurrentuser;

class ClearSpamLimits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spam:clearlimits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all of the Spam limits.';

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
        
        instagramcurrentuser::find(1)->first()->update(['commentSpam' => 0]);
        instagramcurrentuser::find(1)->first()->update(['likeSpam' => 0]);
        instagramcurrentuser::find(1)->first()->update(['followSpam' => 0]);
        instagramcurrentuser::find(1)->first()->update(['unfollowSpam' => 0]);

        $this->info('Spam limits cleared');

        return;
    }
}
