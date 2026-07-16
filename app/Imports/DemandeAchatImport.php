<?php

namespace App\Imports;

use App\Models\DemandeAchat;
use App\Models\LigneBudgetaire;
use App\Models\Utilisateur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DemandeAchatImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Ignorer les lignes vides
            if (empty($row['code'])) {
                continue;
            }

            // Éviter les doublons
            if (DemandeAchat::where('code', $row['code'])->exists()) {
                continue;
            }

            // Vérifier la ligne budgétaire
            if (!LigneBudgetaire::find($row['ligne_budgetaire_id'])) {
                echo "Ligne budgétaire introuvable : {$row['ligne_budgetaire_id']}\n";
                continue;
            }

            // Vérifier l'utilisateur
            if (!Utilisateur::find($row['utilisateur_id'])) {
                echo "Utilisateur introuvable : {$row['utilisateur_id']}\n";
                continue;
            }

            DemandeAchat::create([

                'code' => trim($row['code']),

                'ligne_budgetaire_id' => $row['ligne_budgetaire_id'],

                'utilisateur_id' => $row['utilisateur_id'],

                'estimation' => $this->convertMontant($row['estimation']),

                'date_saisi' => Date::excelToDateTimeObject($row['date_saisi'])->format('Y-m-d'),

                'acheteur' => trim($row['acheteur']),

                'type_projet' => trim($row['type_projet']),

                'categorie' => trim($row['categorie']),

                'statut' => trim($row['statut']),
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