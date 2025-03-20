<?php

namespace App\Livewire\Quiz;

use App\Enums\ParticipantStatus;
use App\Jobs\JoinFormWhatsappSender;
use App\Jobs\WelcomeWhatsappSender;
use App\Livewire\Forms\ParticipantsForm;
use App\Traits\DropDownListTrait;
use App\Traits\EventsTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UbigeoTrait;
use App\Traits\WhatsappTrait;
use Livewire\Component;

class QuizWebLive extends Component
{
    use UbigeoTrait,EventsTrait,ParticipantTrait,DropDownListTrait,WhatsappTrait;
    public string $event_id,$departamento = '',$provincia = '',$imagen = '';
    public $distrito;
    public ParticipantsForm $form;
    public bool $submitted = false;
    public function render()
    {
        if($this->form->email){
            $participant = $this->getParticipantValidateForPhone('email',$this->form->email);
            if ($participant) {
                $this->setParticipantInEvent($participant,$this->event_id);
                $this->sendMessageTheWhatsApp($participant->names.' '.$participant->last_name,$participant->email,$participant->phone);
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
        $rules = [
            'form.names' => 'required',
            'form.last_name' => 'required',
            'form.email' => 'required|email',
            'form.phone' => 'required|min:9',
            'form.country' => 'required',
            'form.educational_institution_type' => 'required',
            'form.policy' => 'required',
        ];
        $messages = [
            'form.names.required' => 'El campo nombres es obligatorio',
            'form.last_name.required' => 'El campo apellidos es obligatorio',
            'form.email.required' => 'El campo email es obligatorio',
            'form.email.email' => 'El campo email debe ser un email válido',
            'form.phone.required' => 'El campo teléfono es obligatorio',
            'form.phone.min' => 'El campo teléfono debe tener al menos 9 caracteres',
            'form.country.required' => 'El campo país es obligatorio',
            'form.educational_institution_type.required' => 'El campo tipo de institución educativa es obligatorio',
            'form.policy.required' => 'Debe aceptar la política de privacidad',
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
        $v['form']['status'] = ParticipantStatus::NewWeb->value;
        unset($v['departamento']);
        unset($v['provincia']);
        unset($v['distrito']);

        $participant = $this->storeParticipant($v['form'], $this->event_id);
        if($participant){
            $this->sendMessageTheWhatsApp($participant->names.' '.$participant->last_name,$participant->email,$participant->phone);
        }

        $this->submitted = true;
    }
    public function sendMessageTheWhatsApp($name,$email,$phone):void
    {
        $phone = '51'.$phone;
        WelcomeWhatsappSender::dispatch( $name,$email,$phone);
        JoinFormWhatsappSender::dispatch($name,$email,$phone);

    }
}
