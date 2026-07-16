<?php

namespace App\Imports;

use App\Models\Prix;
use App\Models\Commande;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrixImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['code'])) {
                continue;
            }

            if (Prix::where('code', $row['code'])->exists()) {
                continue;
            }

            if (!Commande::find($row['commande_id'])) {
                echo "Commande introuvable : {$row['commande_id']}\n";
                continue;
            }

            Prix::create([

                'code' => trim($row['code']),

                'commande_id' => $row['commande_id'],

                'designation' => trim($row['designation_prx']),

                'quantite' => $row['quantite'],

                'prix_unitaire' => $this->convertMontant($row['prix_unitaire'])

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