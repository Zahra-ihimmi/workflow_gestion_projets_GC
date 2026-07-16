<?php

namespace App\Imports;

use App\Models\Assurance;
use App\Models\Fournisseur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AssuranceImport implements ToCollection, WithHeadingRow
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

            Assurance::updateOrCreate(

                [
                    'fournisseur_id' => $row['fournisseur_id'],
                    'police' => trim($row['police'])
                ],

                [
                    'type' => trim($row['type']),
                    'date_debut' => Date::excelToDateTimeObject($row['date_debut'])->format('Y-m-d'),
                    'date_fin' => Date::excelToDateTimeObject($row['date_fin'])->format('Y-m-d'),
                    'quittance' => trim($row['quittance'])
                ]

            );
        }
    }
}