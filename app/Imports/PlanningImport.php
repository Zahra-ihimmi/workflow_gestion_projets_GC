<?php

namespace App\Imports;

use App\Models\Planning;
use App\Models\Prix;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PlanningImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            if (Planning::where('code', $row['code'])->exists()) {
                continue;
            }

            if (!Prix::find($row['prix_id'])) {
                echo "Prix introuvable : {$row['prix_id']}\n";
                continue;
            }

            Planning::create([

                'code' => trim($row['code']),

                'prix_id' => $row['prix_id'],

                'designation' => trim($row['designation']),

                'date_debut' => Date::excelToDateTimeObject($row['date_debut'])->format('Y-m-d'),

                'date_fin_prevue' => Date::excelToDateTimeObject($row['date_fin_prevue'])->format('Y-m-d'),

                'date_debut_reelle' => !empty($row['date_debut_reelle'])
                    ? date('Y-m-d', strtotime($row['date_debut_reelle']))
                    : null,

            ]);
        }
    }
}