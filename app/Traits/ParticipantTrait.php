<?php

namespace App\Traits;

use App\Enums\ParticipantStatus;
use App\Models\Participant;
use App\Services\WaveConnectedService;
use Illuminate\Support\Facades\DB;

trait ParticipantTrait
{
    public function getParticipants($currentStatus,$search = null)
    {
        $search = ($search)?mb_strtoupper($search):null;
        $participants = Participant::orderBy('participants.names','asc');
        if($currentStatus != ' '){
            $participants->where('participants.status',$currentStatus);
        }
        if($search){
            $participants->where('participants.names','like','%'.$search.'%')
            ->orWhere('last_name','like','%'.$search.'%');
        }
        $participants = $participants->join('ubigeos as u','u.id','=','participants.ubigeo_id');

        return $participants->select(
            'participants.id',
            'participants.code_pp',
            'participants.broadcast_list',
            'participants.names',
            'participants.last_name',
            'participants.email',
            'participants.phone',
            'participants.country',
            'u.description as ubigeo',
            'participants.status',
            'participants.created_at'
        );
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
    public function getParticipantsByWhatsapp($currentStatus,$search = null)
    {
        $search = ($search)?mb_strtoupper($search):null;
        $participants =  Participant::orderBy('participants.id','asc')
            ->join('event_participant', 'participants.id', '=', 'event_participant.participant_id')
            ->join('ubigeos as d', 'participants.ubigeo_id', '=', 'd.id')
            ->join('events as e', 'event_participant.event_id', '=', 'e.id')
            ->select(
                DB::raw('CONCAT(participants.names, " ", participants.last_name) as name'),
                DB::raw('IF(participants.country = "PERÚ", CONCAT("51", participants.phone), participants.phone) as phone'),
                'participants.email',
                DB::raw('" " as var_1'),
                DB::raw('" " as var_2'),
                DB::raw('" " as var_3'),
                DB::raw('" " as var_4')
            );
        if($currentStatus != ' '){
            $participants->where('participants.status',$currentStatus);
        }
        if($search){
            $participants->where('participants.names','like','%'.$search.'%')
            ->orWhere('last_name','like','%'.$search.'%');
        }
        return $participants;
    }


}
