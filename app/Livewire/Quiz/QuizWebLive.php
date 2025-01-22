<?php

namespace App\Livewire\Quiz;

use App\Enums\ParticipantStatus;
use App\Livewire\Forms\ParticipantsForm;
use App\Models\Participant;
use App\Traits\DropDownListTrait;
use App\Traits\EventsTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UbigeoTrait;
use Livewire\Component;

class QuizWebLive extends Component
{
    use UbigeoTrait,EventsTrait,ParticipantTrait,DropDownListTrait;
    public string $event_id,$departamento = '',$provincia = '',$imagen = '';
    public $distrito;
    public ParticipantsForm $form;
    public bool $submitted = false;
    public function render()
    {
        if($this->form->email){
            $participant = $this->getParticipantByField('email',$this->form->email);
            if ($participant) {
                $this->setParticipantInEvent($participant,$this->event_id);
                $this->submitted = true;
            }
        }

        return view('livewire.quiz.quiz-web-live',[
            'departamentos' => $this->getDDLDepartamento(),
            'provincias' => $this->getDDLProvincia($this->departamento),
            'distritos' => $this->getDDLDistrito($this->provincia),
            'types' => $this->DDLInstitutionType()
        ]);
    }
    public function mount($event_id)
    {
        $this->event_id = $event_id;
        $this->imagen = $this->getImagenEvent($event_id);
    }
    public function save()
    {
        $this->form->status = ParticipantStatus::NewWeb->value;
        $this->form->ubigeo_id = $this->distrito;
        $this->validate();

        $this->storeParticipant($this->form->all(),$this->event_id);


        $this->submitted = true;
    }
}
