<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FournisseurImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Ignorer les lignes vides
            if (empty($row['id_ariba'])) {
                continue;
            }

            // Éviter les doublons
            if (Fournisseur::where('id_ariba', $row['id_ariba'])->exists()) {
                continue;
            }

            Fournisseur::create([

                'id_ariba' => trim($row['id_ariba']),

                'nom' => trim($row['nom']),

                'logo' => !empty($row['logo']) ? trim($row['logo']) : null,

                'lien_web' => !empty($row['lien_web']) ? trim($row['lien_web']) : null,

            ]);
        }
    }
}