<?php

namespace App\Traits;

use App\Models\Participant;

trait DashboardTrait
{
    public function countParticipantsByStatus($status): int
    {
        return Participant::where('status', $status)->count();
    }
    public function countParticipants()
    {
        return Participant::count();
    }

}
