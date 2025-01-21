<?php

namespace App\Livewire\Events;

use App\Traits\EventsTrait;
use Livewire\Component;
use Livewire\WithPagination;

class EventsDetailsLive extends Component
{
    use EventsTrait,WithPagination;
    public string $event_id;
    public function render()
    {
        return view('livewire.events.events-details-live',[
            'participants' => $this->getParticipantsByEvent($this->event_id)->paginate(10)
        ]);
    }
    public function mount($event_id):void
    {
        $this->event_id = $event_id;
    }
}
