<?php

namespace App\Traits;

use App\Exports\ContactsWhatsappExport;
use App\Exports\ParticipantByEventExport;
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

}
