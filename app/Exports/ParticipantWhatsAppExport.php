<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantWhatsAppExport implements FromQuery,WithHeadings
{
    use Exportable;
    public function __construct(
        public $data,
    )
    {
    }

    public function query()
    {
        return $this->data;
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
