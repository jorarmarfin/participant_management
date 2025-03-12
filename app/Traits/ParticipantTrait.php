<?php

namespace App\Traits;

use App\Enums\ParticipantStatus;
use App\Models\Participant;
use App\Services\WaveConnectedService;

trait ParticipantTrait
{
    public function getParticipants($currentStatus,$search = null)
    {
        $search = ($search)?mb_strtoupper($search):null;
        $participant = Participant::orderBy('names','asc');
        if($currentStatus != ' '){
            $participant->where('status',$currentStatus);
        }
        if($search){
            $participant->where('names','like','%'.$search.'%')
            ->orWhere('last_name','like','%'.$search.'%');
        }
        return $participant;
    }
    public function getParticipant($participant_id)
    {
        return Participant::find($participant_id);

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
    public function isMyContact($participant_id,$phone):bool
    {
        $sw = false;
        $instance = env('WAVECONNECTED_INSTANCE');
        $contact = (new WaveConnectedService)->getContactById($instance,$phone);
        if($contact['data']['data']['isMyContact']){
            $participant = Participant::find($participant_id);
            $participant->status = ParticipantStatus::Attached;
            $participant->save();
            $sw = true;
        }
        return $sw;
    }


}
