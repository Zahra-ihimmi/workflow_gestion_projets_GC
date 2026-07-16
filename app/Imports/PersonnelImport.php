<?php

namespace App\Imports;

use App\Models\Personnel;
use App\Models\Fournisseur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PersonnelImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){

            if(empty($row['cin'])){
                continue;
            }

            if(!Fournisseur::find($row['fournisseur_id'])){
                echo "Fournisseur introuvable : {$row['fournisseur_id']}\n";
                continue;
            }

            Personnel::updateOrCreate(

                ['cin'=>trim($row['cin'])],

                [

                    'fournisseur_id'=>$row['fournisseur_id'],
                    'nom'=>trim($row['nom']),
                    'prenom'=>trim($row['prenom']),
                    'fonction'=>trim($row['fonction']),
                    'photo'=>$row['photo'],
                    'type_contrat'=>trim($row['type_contrat']),
                    'pne'=>trim($row['pne']),
                    'niveau'=>trim($row['niveau']),
                    'date_debut'=>Date::excelToDateTimeObject($row['date_debut'])->format('Y-m-d'),
                    'date_fin'=>Date::excelToDateTimeObject($row['date_fin'])->format('Y-m-d'),

                ]

            );

        }
    }
}