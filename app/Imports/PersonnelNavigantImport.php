<?php

namespace App\Imports;

use App\Models\PersonnelNavigant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonnelNavigantImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if (empty($row['matricule'])) {
                continue;
            }


            PersonnelNavigant::updateOrCreate(
            [
                'matricule' => $row['matricule']
            ],
            [
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'type' => strtoupper($row['type']),
                'base' => strtoupper($row['base']),
                'banque_id' => $row['banque_id'],
                'devise_totale' => $row['montant'] ,
            ]
        );

        }

    }

}