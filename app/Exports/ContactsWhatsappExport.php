<?php

namespace App\Exports;

use App\Traits\EventsTrait;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsWhatsappExport implements FromQuery,WithHeadings
{
    use EventsTrait, Exportable;
    public function __construct(
        public string $event_id,
    )
    {
    }

    public function query()
    {
        return $this->getQueryContactByWhatsapp($this->event_id);
    }
    public function headings(): array
    {
        return [
            'name',
            'phone',
            'email',
            'var_1',
            'var_2',
            'var_3',
            'var_4',
        ];
    }

}
