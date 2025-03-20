<?php

namespace App\Jobs;

use App\Traits\WhatsappTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class WelcomeWhatsappNameSender implements ShouldQueue
{
    use Queueable,WhatsappTrait;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $name)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->sendWhatsAppJoinNameForm($this->name);
    }
}
