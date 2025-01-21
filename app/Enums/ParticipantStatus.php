<?php

namespace App\Enums;

enum ParticipantStatus: string
{
    case New = 'Nuevo';
    case Existing = 'Existente';
    case Registered = 'Registrado';
    case Invited = 'Invitado';
    case Confirmed = 'Confirmado';
    case Attended = 'Asistio';
    case DidNotAttend = 'No asistio';
    case Removed = 'Eliminado';
}
