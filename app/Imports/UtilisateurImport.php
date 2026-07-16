<?php

namespace App\Imports;

use App\Models\Utilisateur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UtilisateurImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Ignorer les lignes vides
            if (empty($row['email'])) {
                continue;
            }

            // Éviter les doublons
            if (Utilisateur::where('email', $row['email'])->exists()) {
                continue;
            }

            Utilisateur::create([

                'matricule' => trim($row['matricule']),

                'nom' => trim($row['nom']),

                'prenom' => trim($row['prenom']),

                'email' => trim($row['email']),

                'motdepasse' => Hash::make($row['motdepasse'])

            ]);
        }
    }
}