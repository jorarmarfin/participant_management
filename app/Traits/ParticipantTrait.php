<?php

namespace App\Traits;

use App\Enums\ParticipantStatus;
use App\Models\Participant;
use App\Services\WaveConnectedService;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

trait ParticipantTrait
{
    public function getParticipants($currentStatus,$search = null,$notSwitch = 0)
    {
        $search = ($search)?mb_strtoupper($search):null;
        $participants = Participant::orderBy('participants.names','asc');
        if($currentStatus != ' '){
            $participants->where('participants.status',$currentStatus);
        }
        if($search){
            $participants->where('participants.names','like','%'.$search.'%')
            ->orWhere('participants.last_name','like','%'.$search.'%')
            ->orWhere('participants.phone','like','%'.$search.'%')
            ;
        }
        if ($notSwitch>0){
            $participants = $this->applyFilter($participants,$notSwitch);
        }
        $participants = $participants->leftjoin('ubigeos as u','u.id','=','participants.ubigeo_id');
        $participants = $participants
            ->orderBy('participants.last_name','asc')
            ->orderBy('participants.names','asc');

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
    public function applyFilter($participant,$filter)
    {
        return match($filter) {
            1 => $participant->whereNull('participants.phone'),
            2 => $participant->whereNull('participants.email'),
            3 => $participant->whereNull('participants.phone')->whereNull('participants.email'),
            default => $participant,
        };

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
    public function getParticipantValidateForPhone($field,$value)
    {
        $participant = Participant::where($field,$value)
            ->whereNotNull('phone')
            ->Where('phone','<>','')
            ->first();

        if($participant){
            if($participant->country=='PERÚ'){
                if(is_null($participant->ubigeo_id)){
                    return null;
                }
            }
        }

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
    public function getParticipantsByWhatsapp($currentStatus,$search = null,$notSwitch = 0)
    {
        $search = ($search)?mb_strtoupper($search):null;
        $participants =  Participant::orderBy('participants.id','asc')
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
        if ($notSwitch>0){
            $participants = $this->applyFilter($participants,$notSwitch);
        }
        return $participants;
    }
    public function sendWhatsapp($phone,$message)
    {
        $instance = env('WAVECONNECTED_INSTANCE');
        return (new WaveConnectedService)->apiSendWhatsapp($instance,$phone,$message);

    }


}
