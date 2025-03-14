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
    /**
     * Count participants by not email
     * @param $status
     * @return mixed
     */
    public function countParticipantsByNotEmail()
    {
        return Participant::whereNull('email')->count();
    }
    public function countParticipantsByPhoneNotValid()
    {
        //length('phone') < 9 or phone not like '9%'
        return Participant::whereRaw('LENGTH(phone) < 9 OR phone NOT LIKE "9%"')->count();
    }

}
