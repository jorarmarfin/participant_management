<?php

namespace App\Livewire\Dashboard;

use App\Traits\DashboardTrait;
use App\Traits\UbigeoTrait;
use Livewire\Component;

class CardCountByUbigeo extends Component
{
    use DashboardTrait,ubigeoTrait;

    public $departamento,$provincia;
    public $total_data,$total_provincia,$total_distrito;

    public function render()
    {
        $this->total_data = $this->getCountParticipantsByDepartamento()->sum('cnt');
        $this->total_provincia = $this->getCountParticipantsByProvincia($this->departamento)->sum('cnt');
        $this->total_distrito = $this->getCountParticipantsByDistrito($this->departamento,$this->provincia)->sum('cnt');

        return view('livewire.dashboard.card-count-by-ubigeo',[
            'data' => $this->getCountParticipantsByDepartamento(),
            'data_provincias' => $this->getCountParticipantsByProvincia($this->departamento),
            'data_distritos' => $this->getCountParticipantsByDistrito($this->departamento,$this->provincia),
            'departamentos' => $this->getDDLDepartamento(),
            'provincias' => $this->getDDLProvincia($this->departamento)
        ]);
    }
}
