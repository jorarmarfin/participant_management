<?php

namespace App\Traits;

use App\Models\Event;
use App\Models\Participant;
use Carbon\Carbon;

trait EventsTrait
{
    public function getEvents(): \Illuminate\Database\Eloquent\Builder
    {
        return Event::orderBy('id','desc');
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
        return Participant::orderBy('id','desc')->whereIn('id', $event->participants->pluck('id')->toArray());
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
        return Participant::orderBy('id','desc')
            ->join('event_participant', 'participants.id', '=', 'event_participant.participant_id')
            ->join('ubigeos as d', 'participants.ubigeo_id', '=', 'd.id')
            ->join('events as e', 'event_participant.event_id', '=', 'e.id')
            ->where('e.id', $event_id)
            ->select('participants.id',
                'participants.names',
                'participants.last_name',
                'participants.email',
                'participants.phone',
                'd.departamento',
                'd.provincia',
                'd.distrito',
                'e.name as evento',
                'participants.status'
            );
    }

}
