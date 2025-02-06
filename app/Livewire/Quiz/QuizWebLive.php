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
            'countries' => $this->getDDLCountries(),
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
        if($this->form->country=='Perú'){
            $this->validate([
                'departamento' => 'required',
                'provincia' => 'required',
                'distrito' => 'required',
            ],[
                'departamento.required' => 'El campo departamento es obligatorio',
                'provincia.required' => 'El campo provincia es obligatorio',
                'distrito.required' => 'El campo distrito es obligatorio',
            ]);

            $this->form->ubigeo_id = $this->distrito;
        }
        else{
            $this->form->ubigeo_id = null;
        }
        $this->form->status = ParticipantStatus::NewWeb->value;
        $this->validate();

        $this->storeParticipant($this->form->all(),$this->event_id);


        $this->submitted = true;
    }
}
