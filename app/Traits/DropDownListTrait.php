<?php

namespace App\Traits;

trait DropDownListTrait
{
    // tipo de institucion educativa
    public function DDLInstitutionType(): array
    {
        return [
            'Colegio del Estado',
            'Colegio Particular Laico',
            'Colegio Particular Religioso',
            'Colegio Público de Gestión de Privada',
            'Instituto/Universidad',
            'No tengo hijos (tengo sobrinos y/o nietos)',
            'Tengo hijos mayores de edad',
        ];
    }

}
