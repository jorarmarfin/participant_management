<?php

namespace App\Livewire\Participant;

use App\Traits\DropDownListTrait;
use App\Traits\ParticipantTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantLive extends Component
{
    use ParticipantTrait,WithPagination,DropDownListTrait;
    public string $currentStatus = ' ';
    public string $search = '';

    public function render()
    {
        return view('livewire.participant.participant-live',[
            'participants'=>$this->getParticipants($this->currentStatus,$this->search)->paginate(50),
            'status'=>$this->DDLStatus(),
        ]);
    }
    public function contact($participant_id,$phone):void
    {
        if($this->isMyContact($participant_id,$phone)){
            $this->dispatch('alert',[
                'title'=>'Contacto',
                'icon'=>'success',
                'message'=>'Contacto adherido'
            ]);
        }else{
            $this->dispatch('alert',[
                'title'=>'Contacto',
                'icon'=>'error',
                'message'=>'Contacto no adherido'
            ]);
        }
    }
}
