<?php

namespace App\Traits;

use App\Models\Event;
use App\Models\Participant;

trait EventsTrait
{
    public function getEvents(): \Illuminate\Database\Eloquent\Builder
    {
        return Event::orderBy('id','desc');
    }
    public function storeEvent(array $data): void
    {
        Event::create($data);
    }
    public function getEventById($id)
    {
        return Event::find($id);
    }
    public function getImagenEvent($id)
    {
        return Event::find($id)->imagen;
    }
    public function getParticipantsByEvent($event_id)
    {
        $event = Event::find($event_id);
        return Participant::orderBy('id','desc')->whereIn('id', $event->participants->pluck('id')->toArray());
    }

}
