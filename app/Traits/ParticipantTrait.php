<?php

namespace App\Traits;

use App\Enums\ParticipantStatus;
use App\Imports\ParticipantsImport;
use App\Jobs\MyContactWhatsappJob;
use App\Models\Participant;
use App\Services\WaveConnectedService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isNull;

trait ParticipantTrait
{
    public function getParticipants($currentStatus, $search = null, $notSwitch = 0, $departament = null, $provincia = null, $distrito = null)
    {
        $search = ($search) ? mb_strtoupper($search) : null;
        $participants = Participant::orderBy('participants.names', 'asc');
        if ($currentStatus != ' ') {
            $participants->where('participants.status', $currentStatus);
        }
        if ($search) {
            $participants->where('participants.names', 'like', '%' . $search . '%')
                ->orWhere('participants.last_name', 'like', '%' . $search . '%')
                ->orWhere('participants.phone', 'like', '%' . $search . '%')
                ->orWhere('participants.code_pp', 'like', '%' . $search . '%');
        }
        if ($notSwitch > 0) {
            $participants = $this->applyFilter($participants, $notSwitch);
        }
        $participants = $participants->leftjoin('ubigeos as u', 'u.id', '=', 'participants.ubigeo_id');

        if ($departament) {
            $participants = $participants->where('u.departamento', 'like', '%' . $departament . '%');
        }

        if ($provincia) {
            $participants = $participants->where('u.provincia', 'like', '%' . $provincia . '%');
        }

        if ($distrito) {
            $participants = $participants->where('u.distrito', 'like', '%' . $distrito . '%');
        }

        $participants = $participants
            ->orderBy('participants.last_name', 'asc')
            ->orderBy('participants.names', 'asc');

        return $participants->select(
            'participants.id',
            'participants.code_pp',
            'participants.broadcast_list',
            'participants.names',
            'participants.last_name',
            'participants.email',
            'participants.phone',
            'participants.country',
            'u.description as ubigeo',
            'participants.status',
            'participants.created_at'
        );
    }

    public function applyFilter($participant, $filter)
    {
        return match ($filter) {
            1 => $participant->whereNull('participants.phone'),
            2 => $participant->whereNull('participants.email'),
            3 => $participant->whereNull('participants.phone')->whereNull('participants.email'),
            default => $participant,
        };

    }

    public function getParticipant($participant_id)
    {
        return Participant::find($participant_id);

    }

    public function storeParticipant($data, $event_id)
    {
        $participant = Participant::create($data);
        if ($participant) {
            $participant->events()->attach($event_id);
            return $participant;
        } else {
            return null;
        }
    }

    public function getParticipantValidateForPhone($field, $value)
    {
        $participant = Participant::where($field, $value)
            ->whereNotNull('phone')
            ->Where('phone', '<>', '')
            ->first();

        if ($participant) {
            if ($participant->country == 'PERÚ') {
                if (is_null($participant->ubigeo_id)) {
                    return null;
                }
            }
        }

        return $participant;
    }

    public function getParticipantByField($field, $value)
    {
        return Participant::where($field, $value)->first();
    }

    public function setParticipantInEvent($participant, $event_id): void
    {
        $participant->events()->syncWithoutDetaching($event_id);
    }

    public function isMyContact($participant_id, $phone): bool
    {
        $sw = false;
        $contact = (new WaveConnectedService)->getContactById($phone);
        if ($contact['data']['data']['isMyContact']) {
            $participant = Participant::find($participant_id);
            $participant->status = ParticipantStatus::Attached;
            $participant->save();
            $sw = true;
        }
        return $sw;
    }

    public function analyzeIsMyContact(): void
    {
        $participants = Participant::where('status', ParticipantStatus::NewWeb->value)
            ->whereNotNull('phone')
            ->where('phone', '<>', '')
            ->get();
        if ($participants) {
            foreach ($participants as $participant) {
                MyContactWhatsappJob::dispatch($participant->id, $participant->phone);
            }
        }
    }

    public function getParticipantsByWhatsapp($currentStatus, $search = null, $notSwitch = 0, $departament = null, $provincia = null, $distrito = null)
    {
        $search = ($search) ? mb_strtoupper($search) : null;
        $participants = Participant::orderBy('participants.id', 'asc')
            ->select(
                DB::raw('CONCAT(COALESCE(participants.names, ""), " ", COALESCE(participants.last_name, "")) as name'),
                DB::raw('IF(participants.country = "PERÚ", CONCAT("51", participants.phone), participants.phone) as phone'),
                'participants.email',
                DB::raw('" " as var_1'),
                DB::raw('" " as var_2'),
                DB::raw('" " as var_3'),
                DB::raw('" " as var_4')
            );
        if ($currentStatus != ' ') {
            $participants->where('participants.status', $currentStatus);
        }
        if ($search) {
            $participants->where('participants.names', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('participants.code_pp', 'like', '%' . $search . '%');;
        }
        if ($notSwitch > 0) {
            $participants = $this->applyFilter($participants, $notSwitch);
        }

        $participants = $participants->leftjoin('ubigeos as u', 'u.id', '=', 'participants.ubigeo_id');

        if ($departament) {
            $participants = $participants->where('u.departamento', 'like', '%' . $departament . '%');
        }

        if ($provincia) {
            $participants = $participants->where('u.provincia', 'like', '%' . $provincia . '%');
        }

        if ($distrito) {
            $participants = $participants->where('u.distrito', 'like', '%' . $distrito . '%');
        }


        return $participants;
    }

    public function uploadParticipant($file_name)
    {
        Excel::import(new ParticipantsImport, $file_name);

    }


}
