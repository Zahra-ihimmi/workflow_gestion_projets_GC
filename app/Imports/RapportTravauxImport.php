<?php

namespace App\Imports;

use App\Models\Commande;
use App\Models\RapportTravaux;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RapportTravauxImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            if (!Commande::find($row['commande_id'])) {
                echo "Commande introuvable : {$row['commande_id']}\n";
                continue;
            }

            RapportTravaux::updateOrCreate(

                ['code' => trim($row['code'])],

                [

                    'commande_id' => $row['commande_id'],

                    'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),

                    'ecart_hse' => trim($row['ecart_hse']),

                    'ecart_qualite' => trim($row['ecart_qualite'])

                ]

            );
        }
    }
}