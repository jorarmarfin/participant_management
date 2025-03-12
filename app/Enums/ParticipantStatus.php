<?php

namespace App\Enums;

enum ParticipantStatus: string
{
    case New = 'Nuevo (Charla)';
    case NewWeb = 'Nuevo (web)';
    case Attached = 'Adherido';
    case RecurrentChat = 'Recurrente (Charla)';
    case newPetition = 'Nuevo (firmó petición)';
    case invited = 'Invitado a adherirse';
    public static function getAllParticipantStatuses(): array
    {
        return array_column(ParticipantStatus::cases(), 'value');
    }


}
