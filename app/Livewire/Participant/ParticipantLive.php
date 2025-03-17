<?php

namespace App\Livewire\Participant;

use App\Traits\DropDownListTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UtilsTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantLive extends Component
{
    use ParticipantTrait,WithPagination,DropDownListTrait,UtilsTrait;
    public string $currentStatus = ' ';
    public string $search = '';
    public int $notSwitch = 0;

    public function render()
    {
        return view('livewire.participant.participant-live',[
            'participants'=>$this->getParticipants($this->currentStatus,$this->search,$this->notSwitch)->paginate(50),
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
    public function downLoadFile($code)
    {
        return match ($code) {
            'PE' => $this->downloadExcelParticipant(
                $this->getParticipants($this->currentStatus,$this->search,$this->notSwitch),
                'participants.xlsx'
            ),
            'WP' => $this->downloadExcelParticipantWhatsapp(
                $this->getParticipantsByWhatsapp($this->currentStatus,$this->search,$this->notSwitch),
                'contacts.xlsx'
            ),
        };

    }
}
