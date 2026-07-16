<?php

namespace App\Imports;

use App\Models\Commande;
use App\Models\NonConformite;
use App\Models\Personnel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NonConformiteImport implements ToCollection, WithHeadingRow
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

            if (!Personnel::where('cin', trim($row['personnel_cin']))->exists()) {
                echo "Personnel introuvable : {$row['personnel_cin']}\n";
                continue;
            }

            NonConformite::updateOrCreate(

                ['code' => trim($row['code'])],

                [

                    'commande_id' => $row['commande_id'],
                    'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                    'classe' => trim($row['classe']),
                    'type' => trim($row['type']),
                    'echeance' => Date::excelToDateTimeObject($row['echeance'])->format('Y-m-d'),
                    'personnel_cin' => trim($row['personnel_cin'])

                ]

            );

        }
    }
}