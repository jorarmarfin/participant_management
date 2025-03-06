<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Attributes\Validate;
use Livewire\Form;

#[AllowDynamicProperties] class ParticipantsFormationForm extends Form
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
    public string $country = 'Perú';

    public string $status = '';

    public $ubigeo_id;


}
