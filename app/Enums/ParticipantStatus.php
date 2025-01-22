<?php

namespace App\Enums;

enum ParticipantStatus: string
{
    case New = 'Nuevo (Charla)';
    case NewWeb = 'Nuevo (web)';
    case Attached = 'Adherido';
    case RecurrentChat = 'Recurrente (Charla)';
}
