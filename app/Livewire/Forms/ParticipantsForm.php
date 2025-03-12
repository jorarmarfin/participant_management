<?php

namespace App\Livewire\Forms;

use App\Models\Participant;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ParticipantsForm extends Form
{
    public ?Participant $participant;

    #[Validate('required')]
    public string $names = '';

    #[Validate('required')]
    public string $last_name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $phone = '';

    #[Validate('required')]
    public string $country = 'Perú';

    public $ubigeo_id;

    #[Validate('required')]
    public string $educational_institution_type = '';

    #[Validate('required')]
    public bool $policy = false;

    public string $status = '';

    public function setParticipant(Participant $participant)
    {
        $this->participant = $participant;
        $this->email = $participant->email;
        $this->names = $participant->names;
        $this->last_name = $participant->last_name;
        $this->phone = $participant->phone;
        $this->educational_institution_type = $participant->educational_institution_type ?? '';
    }

    public function updatedPhone($value)
    {
        // Limpia el valor eliminando caracteres no numéricos
        $this->phone = preg_replace('/[^0-9]/', '', $value);
    }


}
