<?php

namespace App\Livewire\Forms;

use App\Models\Participant;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ParticipantsForm extends Form
{
    #[Validate('required')]
    public string $names = '';

    #[Validate('required')]
    public string $last_name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $phone = '';

    #[Validate('required')]
    public int $ubigeo_id = 0;

    #[Validate('required')]
    public string $educational_institution_type = '';

    #[Validate('required')]
    public bool $policy = false;

    public string $status = '';

    public function updatedPhone($value)
    {
        // Limpia el valor eliminando caracteres no numéricos
        $this->phone = preg_replace('/[^0-9]/', '', $value);
    }


}
