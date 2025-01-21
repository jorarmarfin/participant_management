<?php

namespace App\Traits;

use App\Enum\PetitionEnum;
use App\Models\Ubigeo;

trait UbigeoTrait
{
    public function getDDLDepartamento()
    {
        return Ubigeo::OrderBy('departamento')->distinct()->pluck('departamento');
    }
    public function getDDLProvincia($departamento)
    {
        return Ubigeo::where('departamento',$departamento)->distinct()->pluck('provincia');
    }
    public function getDDLDistrito($provincia)
    {
        return Ubigeo::where('provincia',$provincia)->select('distrito as name','id')->get();
    }

}
