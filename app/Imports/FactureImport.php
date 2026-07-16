<?php

namespace App\Imports;

use App\Models\Facture;
use App\Models\Decompte;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FactureImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            if (Facture::where('code', $row['code'])->exists()) {
                continue;
            }

            if (!Decompte::find($row['decompte_id'])) {
                echo "Décompte introuvable : {$row['decompte_id']}\n";
                continue;
            }

            Facture::create([

                'code' => trim($row['code']),

                'decompte_id' => $row['decompte_id'],

                'date_depot' => Date::excelToDateTimeObject($row['date_depot'])->format('Y-m-d'),

                'montant' => $this->convertMontant($row['montant'])

            ]);
        }
    }

    private function convertMontant($montant)
    {
        $montant = str_replace("\u{00A0}", '', $montant);
        $montant = str_replace(' ', '', $montant);
        $montant = str_replace(',', '.', $montant);

        return (float) $montant;
    }
}