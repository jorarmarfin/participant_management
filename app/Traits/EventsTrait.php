<?php

namespace App\Traits;

use App\Models\Event;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait EventsTrait
{
    public function getEvents()
    {
        return Event::orderBy('id', 'desc');
    }

    public function storeEvent(array $data): void
    {
        Event::create($data);
    }

    public function getEventById($id)
    {
        return Event::find($id);
    }

    public function getImagenEvent($id)
    {
        return Event::find($id)->imagen;
    }

    public function getParticipantsByEvent($event_id)
    {
        $event = Event::find($event_id);
        return Participant::orderBy('created_at', 'desc')->whereIn('id', $event->participants->pluck('id')->toArray());
    }

    public function getMessageToSend($fecha): string
    {
        Carbon::setLocale('es'); // Asegurar idioma español

        $fechaCarbon = Carbon::parse($fecha);

        return sprintf(
            'El enlace te llegará el %s por la mañana',
            $fechaCarbon->translatedFormat('j \d\e F')
        );
    }

    public function getQueryParticipantsByEvent($event_id)
    {
        return Participant::orderBy('participants.id', 'asc')
            ->join('event_participant', 'participants.id', '=', 'event_participant.participant_id')
            ->join('ubigeos as d', 'participants.ubigeo_id', '=', 'd.id')
            ->join('events as e', 'event_participant.event_id', '=', 'e.id')
            ->where('e.id', $event_id)
            ->select('participants.id',
                'participants.names',
                'participants.last_name',
                'participants.email',
                'participants.phone',
                'participants.country',
                'd.departamento',
                'd.provincia',
                'd.distrito',
                'e.name as evento',
                'participants.created_at',
                'participants.status'
            );
    }

    public function getQueryContactByWhatsapp($event_id)
    {
        return Participant::orderBy('participants.id','asc')
            ->join('event_participant', 'participants.id', '=', 'event_participant.participant_id')
            ->join('events as e', 'event_participant.event_id', '=', 'e.id')
            ->where('e.id', $event_id)
            ->select(
                DB::raw('CONCAT(COALESCE(participants.names, ""), " ", COALESCE(participants.last_name, "")) as name'),
                DB::raw('IF(participants.country = "PERÚ", CONCAT("51", participants.phone), participants.phone) as phone'),
                'participants.email',
                DB::raw('" " as var_1'),
                DB::raw('" " as var_2'),
                DB::raw('" " as var_3'),
                DB::raw('" " as var_4')
            );
    }
    public function getEventByField($field, $value)
    {
        return Event::where($field, $value)->first();
    }


}
