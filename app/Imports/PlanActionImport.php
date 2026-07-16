<?php

namespace App\Imports;

use App\Models\Commande;
use App\Models\Personnel;
use App\Models\PlanAction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PlanActionImport implements ToCollection, WithHeadingRow
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

            PlanAction::updateOrCreate(

                ['code' => trim($row['code'])],

                [

                    'commande_id' => $row['commande_id'],
                    'personnel_cin' => trim($row['personnel_cin']),
                    'date_spa' => Date::excelToDateTimeObject($row['date_spa'])->format('Y-m-d'),
                    'activite' => trim($row['activite']),
                    'dangers' => trim($row['dangers']),
                    'mesures_preventives' => trim($row['mesures_preventives'])

                ]

            );

        }
    }
}