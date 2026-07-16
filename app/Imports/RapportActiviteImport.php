<?php

namespace App\Imports;

use App\Models\Prix;
use App\Models\RapportActivite;
use App\Models\RapportTravaux;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RapportActiviteImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['rapport_travaux_id'])) {
                continue;
            }

            if (!RapportTravaux::find($row['rapport_travaux_id'])) {
                echo "Rapport travaux introuvable : {$row['rapport_travaux_id']}\n";
                continue;
            }

            if (!Prix::find($row['prix_id'])) {
                echo "Prix introuvable : {$row['prix_id']}\n";
                continue;
            }

            RapportActivite::updateOrCreate(

                [

                    'rapport_travaux_id' => $row['rapport_travaux_id'],
                    'prix_id' => $row['prix_id']

                ],

                [

                    'activite' => trim($row['activite']),
                    'avancement' => $row['avancement']

                ]

            );
        }
    }
}