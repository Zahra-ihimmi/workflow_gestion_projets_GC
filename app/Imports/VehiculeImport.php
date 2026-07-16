<?php

namespace App\Imports;

use App\Models\Vehicule;
use App\Models\Fournisseur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class VehiculeImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['fournisseur_id'])) {
                continue;
            }

            if (!Fournisseur::find($row['fournisseur_id'])) {
                echo "Fournisseur introuvable : {$row['fournisseur_id']}\n";
                continue;
            }

            Vehicule::updateOrCreate(

                [

                    'fournisseur_id' => $row['fournisseur_id'],
                    'type' => trim($row['type'])

                ],

                [

                    'type_habilitation' => trim($row['type_habilitation']),
                    'date_debut' => Date::excelToDateTimeObject($row['date_debut'])->format('Y-m-d'),
                    'date_fin' => Date::excelToDateTimeObject($row['date_fin'])->format('Y-m-d')

                ]

            );
        }
    }
}