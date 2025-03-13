<?php

namespace App\Traits;

use App\Exports\ContactsWhatsappExport;
use App\Exports\ParticipantByEventExport;
use App\Exports\ParticipantExport;
use App\Exports\ParticipantWhatsAppExport;
use Maatwebsite\Excel\Facades\Excel;

trait UtilsTrait
{
    public function downloadExcelParticipantByEvent($event_id, $filename)
    {
        return Excel::download(new ParticipantByEventExport($event_id), $filename);
    }
    public function downloadContactsWhatsappExport($event_id, $filename)
    {
        return Excel::download(new ContactsWhatsappExport($event_id), $filename);
    }
    public function downloadExcelParticipant($data, $filename)
    {
        return Excel::download(new ParticipantExport($data), $filename);
    }
    public function downloadExcelParticipantWhatsapp($data, $filename)
    {
        return Excel::download(new ParticipantWhatsAppExport($data), $filename);
    }
}
