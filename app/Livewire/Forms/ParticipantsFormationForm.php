<?php

namespace App\Livewire\Forms;

use App\Models\Participant;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ParticipantsFormationForm extends Form
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

    public string $status = '';


}
