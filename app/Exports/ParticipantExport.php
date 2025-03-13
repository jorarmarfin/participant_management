<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromQuery,WithHeadings
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
            'ID',
            'código pp',
            'Lista difusión',
            'Nombres',
            'Apellidos',
            'Email',
            'Teléfono',
            'Pais',
            'Ubigeo',
            'Estatus',
            'Fecha de registro'
        ];
    }
}
