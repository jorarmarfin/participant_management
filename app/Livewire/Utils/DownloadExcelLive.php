<?php

namespace App\Livewire\Utils;

use App\Exports\ParticipantByEventExport;
use App\Traits\UtilsTrait;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadExcelLive extends Component
{
    use UtilsTrait;
    public $event_id;
    public function render()
    {
        return view('livewire.utils.download-excel-live');
    }
    public function mount($event_id)
    {
        $this->event_id = $event_id;
    }
    public function downLoadFile($code)
    {
        return match ($code) {
            'PBE' => $this->downloadExcelParticipantByEvent($this->event_id, 'participant_by_event.xlsx'),
            'CBW' => $this->downloadContactsWhatsappExport($this->event_id, 'contacts_by_whatsapp.xlsx'),
            default => redirect()->route('download.excel', ['event_id' => $this->event_id]),
        };

    }
}
