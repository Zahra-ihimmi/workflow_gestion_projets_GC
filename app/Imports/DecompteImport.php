<?php

namespace App\Imports;

use App\Models\Decompte;
use App\Models\Commande;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DecompteImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            if (Decompte::where('code', $row['code'])->exists()) {
                continue;
            }

            if (!Commande::find($row['commande_id'])) {
                echo "Commande introuvable : {$row['commande_id']}\n";
                continue;
            }

            Decompte::create([

                'code' => trim($row['code']),

                'commande_id' => $row['commande_id'],

                'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                'designation' => trim($row['designation']),

                'quantite_attachee' => $row['quantite_attachee'],

                'num_ses' => trim($row['num_ses']),

                'num_rec_ses' => trim($row['num_rec_ses']),

                'statut_validation' => trim($row['statut_validation'])

            ]);
        }
    }
}