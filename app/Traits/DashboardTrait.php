<?php

namespace App\Traits;

use App\Models\Participant;
use Illuminate\Support\Facades\DB;

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

    public function getCountParticipantsByDepartamento()
    {
        $data = Participant::join('ubigeos as u', 'participants.ubigeo_id', '=', 'u.id')
            ->select(
                'u.departamento',
                DB::raw('COUNT(*) as cnt'),
                DB::raw('COUNT(signature_id) as cnt_signature'),
                            )
            ->groupBy('u.departamento')
            ->orderBy('u.departamento', 'asc');

        return $data->get();
    }
    public function getCountParticipantsByProvincia($departamento)
    {
        return Participant::join('ubigeos as u', 'participants.ubigeo_id', '=', 'u.id')
            ->select(
                'u.departamento',
                'u.provincia',
                DB::raw('COUNT(*) as cnt'),
                DB::raw('COUNT(signature_id) as cnt_signature'),
            )
            ->where('u.departamento', $departamento)
            ->groupBy('u.departamento')
            ->groupBy('u.provincia')
            ->orderBy('u.provincia', 'asc')
            ->get();
    }
    public function getCountParticipantsByDistrito($departamento, $provincia)
    {
        return Participant::join('ubigeos as u', 'participants.ubigeo_id', '=', 'u.id')
            ->select(
                'u.departamento',
                'u.provincia',
                'u.distrito',
                DB::raw('COUNT(*) as cnt'),
                DB::raw('COUNT(signature_id) as cnt_signature'),
            )
            ->where('u.departamento', $departamento)
            ->where('u.provincia', $provincia)
            ->groupBy('u.departamento')
            ->groupBy('u.provincia')
            ->groupBy('u.distrito')
            ->orderBy('u.distrito', 'asc')
            ->get();
    }

}
