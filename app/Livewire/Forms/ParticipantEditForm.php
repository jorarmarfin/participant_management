<?php

namespace App\Livewire\Forms;

use App\Models\Participant;
use Illuminate\Support\Str;
use Livewire\Form;

class ParticipantEditForm extends Form
{
    public ?Participant $participant;

    public string $code_pp = '';
    public string $broadcast_list = '';
    public string $names = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $country = 'Perú';
    public $ubigeo_id;
    public string $educational_institution_type = '';
    public string $status = '';

    public function setParticipant(Participant $participant)
    {
        $this->participant = $participant;
        $this->code_pp = $participant->code_pp ?? '';
        $this->broadcast_list = $participant->broadcast_list ?? '';
        $this->names = $participant->names;
        $this->email = $participant->email;
        $this->last_name = $participant->last_name;
        $this->phone = $participant->phone;
        $this->educational_institution_type = $participant->educational_institution_type ?? '';
        $this->country = mb_strtolower($participant->country);
        $this->country = Str::ucfirst($this->country);
    }
    public function updateParticipant()
    {
        $this->participant->update([
            'code_pp' => $this->code_pp,
            'broadcast_list' => $this->broadcast_list,
            'names' => $this->names,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'educational_institution_type' => $this->educational_institution_type,
            'ubigeo_id' => $this->ubigeo_id,
        ]);

    }


}
