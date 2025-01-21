<?php

namespace App\Livewire\Participant;

use App\Traits\ParticipantTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantLive extends Component
{
    use ParticipantTrait,WithPagination;

    public function render()
    {
        return view('livewire.participant.participant-live',[
            'participants'=>$this->getParticipants()->paginate(50)
        ]);
    }
}
