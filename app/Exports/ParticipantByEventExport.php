<?php

namespace App\Exports;

use App\Models\Event;
use App\Traits\EventsTrait;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantByEventExport implements FromQuery,WithHeadings
{
    use EventsTrait, Exportable;
    public function __construct(
        public string $event_id,
    )
    {
    }


    public function query()
    {
        return $this->getQueryParticipantsByEvent($this->event_id)->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nombres',
            'Apellidos',
            'Email',
            'Telefono',
            'Departamento',
            'Provincia',
            'Distrito',
            'evento',
            'Estatus'
        ];
    }
}
