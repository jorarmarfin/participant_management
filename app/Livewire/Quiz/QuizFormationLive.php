<?php

namespace App\Livewire\Quiz;

use App\Enums\ParticipantStatus;
use App\Livewire\Forms\ParticipantsFormationForm;
use App\Traits\DropDownListTrait;
use App\Traits\EventsTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UbigeoTrait;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class QuizFormationLive extends Component
{
    use UbigeoTrait, EventsTrait, ParticipantTrait, DropDownListTrait;

    public string $event_id, $departamento = '', $provincia = '', $imagen = '', $start_date = '';
    public $distrito;
    public ParticipantsFormationForm $form;
    public bool $submitted = false;

    public function render()
    {
        if ($this->form->email) {
            $participant = $this->getParticipantByField('email', $this->form->email);
            if ($participant) {
                $this->setParticipantInEvent($participant, $this->event_id);
                $this->submitted = true;
            }
        }

        return view('livewire.quiz.quiz-formation-live', [
            'countries' => $this->getDDLCountries(),
            'departamentos' => $this->getDDLDepartamento(),
            'provincias' => $this->getDDLProvincia($this->departamento),
            'distritos' => $this->getDDLDistrito($this->provincia),
            'types' => $this->DDLInstitutionType(),
        ]);
    }

    public function mount($event_id)
    {
        $this->event_id = $event_id;
        $event = $this->getEventById($event_id);
        $this->start_date = $this->getMessageToSend($event->start_date);
        $this->imagen = $this->getImagenEvent($event_id);
    }

    /**
     * @throws ValidationException
     */
    public function save()
    {
        $rules = [
            'form.names' => 'required',
            'form.last_name' => 'required',
            'form.email' => 'required|email',
            'form.phone' => 'required|min:9',
            'form.country' => 'required',
        ];
        $messages = [
            'form.names.required' => 'El campo nombres es obligatorio',
            'form.last_name.required' => 'El campo apellidos es obligatorio',
            'form.email.required' => 'El campo email es obligatorio',
            'form.email.email' => 'El campo email debe ser un email válido',
            'form.phone.required' => 'El campo teléfono es obligatorio',
            'form.phone.min' => 'El campo teléfono debe tener al menos 9 caracteres',
            'form.country.required' => 'El campo país es obligatorio',
        ];

        if ($this->form->country == 'Perú') {
            $rules = array_merge($rules, [
                'departamento' => 'required',
                'provincia' => 'required',
                'distrito' => 'required',
                'form.ubigeo_id' => 'required',
            ]);

            $messages = array_merge($messages, [
                'departamento.required' => 'El campo departamento es obligatorio',
                'provincia.required' => 'El campo provincia es obligatorio',
                'distrito.required' => 'El campo distrito es obligatorio',
            ]);
            $this->form->ubigeo_id = $this->distrito;
        } else {
            $this->form->ubigeo_id = null;
        }

        $this->form->phone = str_replace(['_', '-'], '', $this->form->phone);
        $v = $this->validate($rules, $messages);
        $v['form']['status'] = ParticipantStatus::New->value;
        unset($v['departamento']);
        unset($v['provincia']);
        unset($v['distrito']);
        $this->storeParticipant($v['form'], $this->event_id);

        $this->submitted = true;
    }
}
