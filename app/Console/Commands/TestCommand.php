<?php

namespace App\Console\Commands;

use App\Services\WaveConnectedService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $instance = env('WAVECONNECTED_INSTANCE');
        $this->info('Instance: '.$instance);
        $phone = '992949424';
        $contact = (new WaveConnectedService)->getContactById($instance,$phone);
        $this->info(json_encode($contact));
    }
}
