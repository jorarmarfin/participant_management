<?php

namespace App\Jobs;

use App\Traits\ParticipantTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MyContactWhatsappJob implements ShouldQueue
{
    use Queueable, ParticipantTrait;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $participant_id,
        public string $phone,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->isMyContact($this->participant_id, $this->phone);
    }
}
