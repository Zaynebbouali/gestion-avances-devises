<?php

namespace App\Imports;

use App\Models\DeficitCaisse;
use App\Models\PersonnelNavigant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeficitCaisseImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $pn = PersonnelNavigant::where(
            'matricule',
            $row['matricule']
        )->first();

        if (!$pn) {
            return null;
        }

        return new DeficitCaisse([
            'montant' => $row['montant'],
            'reste' => 0,
            'date' => now(),
            'personnel_navigant_id' => $pn->id,
        ]);
    }
}