<?php

namespace App\Console\Commands;

use App\Jobs\JoinFormWhatsappSender;
use App\Jobs\WelcomeWhatsappSender;
use App\Traits\ParticipantTrait;
use App\Traits\WhatsappTrait;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    use WhatsappTrait,ParticipantTrait;
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
//        $name = 'Luis Mayta';
//        $phone = '51992949424';
//        $email = 'luis.mayta@gmail.com';
////        WelcomeWhatsappSender::dispatch($name,$email,$phone);
//        JoinFormWhatsappSender::dispatch($name,$email,$phone);
//        $this->info('enviado');
        $this->analyzeIsMyContact();
    }
}
