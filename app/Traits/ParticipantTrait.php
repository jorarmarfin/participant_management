<?php

namespace App\Traits;

use App\Models\Participant;

trait ParticipantTrait
{
    public function getParticipants()
    {
        $participant = Participant::query();

        return $participant;
    }
    public function storeParticipant($data,$event_id)
    {
        $participant = Participant::create($data);
        $participant->events()->attach($event_id);
        return $participant;
    }
    public function getParticipantByField($field,$value)
    {
        return Participant::where($field,$value)->first();
    }
    public function setParticipantInEvent($participant,$event_id):void
    {
        $participant->events()->syncWithoutDetaching($event_id);
    }
    public function isContact()
    {

    }

}
