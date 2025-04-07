<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel,WithHeadingRow
{
    public function model(array $row): Participant
    {
        return new Participant([
            'names'  => $row['names'],
            'last_name'  => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
        ]);
    }
}
