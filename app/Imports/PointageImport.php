<?php

namespace App\Imports;

use App\Models\Pointage;
use App\Models\Personnel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PointageImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            $personnel = Personnel::where('cin', trim($row['personnel_cin']))->first();

            if (!$personnel) {
                echo "Personnel introuvable : {$row['personnel_cin']}\n";
                continue;
            }

            Pointage::updateOrCreate(

                ['code' => trim($row['code'])],

                [
                    'personnel_cin' => trim($row['personnel_cin']),
                    'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                    'nb_heure' => $row['nb_heure']
                ]

            );
        }
    }
}