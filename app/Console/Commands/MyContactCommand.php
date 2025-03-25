<?php

namespace App\Console\Commands;

use App\Traits\ParticipantTrait;
use Illuminate\Console\Command;

class MyContactCommand extends Command
{
    use ParticipantTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:my-contact-command';

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
        $this->analyzeIsMyContact();
    }
}
