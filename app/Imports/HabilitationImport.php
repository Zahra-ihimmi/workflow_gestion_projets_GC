<?php

namespace App\Imports;

use App\Models\Habilitation;
use App\Models\Personnel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HabilitationImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row){

            if(empty($row['personnel_cin'])){
                continue;
            }
            $personnel = Personnel::where('cin', trim($row['personnel_cin']))->first();

            if (!$personnel) {
                echo "Personnel introuvable : {$row['personnel_cin']}\n";
                continue;
            }
            

            Habilitation::updateOrCreate(

                [

                    'personnel_cin'=>$row['personnel_cin'],
                    'type'=>trim($row['type'])

                ],

                [

                    'date_obtention'=>Date::excelToDateTimeObject($row['date_obtention'])->format('Y-m-d'),
                    'duree_habilitation'=>$row['duree_habilitation']

                ]

            );

        }
    }
}