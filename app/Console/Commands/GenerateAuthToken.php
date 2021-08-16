<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAuthToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate api token';



    /**
     * Execute the token command echo out token from env and bearer hashed.
     *
     * @return int
     */
    public function handle()
    {
        $token = env('TOKEN');
        $this->info($token);
        $bearer = hash('sha256', $token);
        $this->info($bearer);
        return 0;
    }
}
