<?php

namespace App\Imports;

use App\Models\Formation;
use App\Models\Personnel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FormationImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row){

            if(empty($row['code'])){
                continue;
            }

            $personnel = Personnel::where('cin', trim($row['personnel_cin']))->first();

            if (!$personnel) {
                echo "Personnel introuvable : {$row['personnel_cin']}\n";
                continue;
            }

            Formation::updateOrCreate(

                ['code'=>trim($row['code'])],

                [

                    'personnel_cin'=>$row['personnel_cin'],
                    'date'=>Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                    'theme'=>trim($row['theme']),
                    'animateur'=>trim($row['animateur']),
                    'score'=>$row['score']

                ]

            );

        }
    }
}