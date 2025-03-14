<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ParticipantStatus;
use App\Http\Controllers\Controller;
use App\Traits\DashboardTrait;

class DashboardController extends Controller
{
    use DashboardTrait;
    public function index()
    {
        return view('dashboard',[
            'count_new' => $this->countParticipantsByStatus(ParticipantStatus::New->value),
            'count_new_web' => $this->countParticipantsByStatus(ParticipantStatus::NewWeb->value),
            'count_attached' => $this->countParticipantsByStatus(ParticipantStatus::Attached->value),
            'count_recurrent_chat' => $this->countParticipantsByStatus(ParticipantStatus::RecurrentChat->value),
            'count_new_petition' => $this->countParticipantsByStatus(ParticipantStatus::newPetition->value),
            'count_invited' => $this->countParticipantsByStatus(ParticipantStatus::invited->value),
            'count_participants' => $this->countParticipants(),
            'count_not_email' => $this->countParticipantsByNotEmail(),
            'count_phone_not_valid' => $this->countParticipantsByPhoneNotValid(),
        ]);

    }
}
