<?php

namespace App\Livewire\Participant;

use App\Livewire\Forms\ParticipantEditForm;
use App\Traits\DropDownListTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UbigeoTrait;
use Livewire\Component;

class ParticipantEditLive extends Component
{
    use ParticipantTrait, UbigeoTrait, DropDownListTrait;

    public ParticipantEditForm $form;
    public $event_id, $departamento = '', $provincia = '', $imagen = '';
    public $distrito;

    public function render()
    {
        return view('livewire.participant.participant-edit-live', [
            'countries' => $this->getDDLCountries(),
            'departamentos' => $this->getDDLDepartamento(),
            'provincias' => $this->getDDLProvincia($this->departamento),
            'distritos' => $this->getDDLDistrito($this->provincia),
            'types' => $this->DDLInstitutionType()

        ]);
    }

    public function mount($id): void
    {
        $participant = $this->getParticipant($id);
        $this->form->setParticipant($participant);
        $ubigeo = $this->getUbigeoDescription($participant->ubigeo_id);
        if($ubigeo){
            $this->departamento = $ubigeo['departamento'];
            $this->provincia = $ubigeo['provincia'];
            $this->distrito = $participant->ubigeo_id;
        }
    }

    public function updateForm()
    {
        if($this->form->country === 'Perú'){
            $this->form->ubigeo_id = $this->distrito;
        }else{
            $this->form->ubigeo_id = null;
            $this->departamento = '';
            $this->provincia = '';
            $this->distrito = '';
        }
        $this->form->updateParticipant();
    }
}
