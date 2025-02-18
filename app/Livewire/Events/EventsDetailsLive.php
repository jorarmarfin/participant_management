<?php

namespace App\Livewire\Events;

use App\Enums\ParticipantStatus;
use App\Traits\EventsTrait;
use App\Traits\ParticipantTrait;
use Livewire\Component;
use Livewire\WithPagination;

class EventsDetailsLive extends Component
{
    use EventsTrait,WithPagination,participantTrait;
    public string $event_id;
    public function render()
    {
        return view('livewire.events.events-details-live',[
            'participants' => $this->getParticipantsByEvent($this->event_id)->paginate(50)
        ]);
    }
    public function mount($event_id):void
    {
        $this->event_id = $event_id;
    }
    public function contact($participant_id,$phone):void
    {
        $this->isMyContact($participant_id,$phone);
    }
}
