<?php

namespace App\Jobs;

use App\Traits\WhatsappTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class WelcomeWhatsappSender implements ShouldQueue
{
    use Queueable, WhatsappTrait;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $name, public string $phone)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->sendWhatsAppWelcome($this->name, $this->phone);
    }
}
