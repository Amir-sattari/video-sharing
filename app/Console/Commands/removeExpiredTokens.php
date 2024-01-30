<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class removeExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:remove {--day=7 : The number of days to retain expired tokens}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiration = config('sanctum.expiration');
        if($expiration)
        {
            $day = $this->option('day');
            $tokens = PersonalAccessToken::where('created_at', '<', now()->subMinutes($expiration + ($day * 24 * 60)));
            $tokens->delete();
            $this->info('all expired tokens have been deleted');
            return 0;
        }

        $this->warn('expire time is not set');
        return 1;
    }
}
