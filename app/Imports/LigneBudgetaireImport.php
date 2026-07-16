<?php

namespace App\Imports;

use App\Models\LigneBudgetaire;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LigneBudgetaireImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Ignorer les lignes vides
            if (empty($row['code'])) {
                continue;
            }

            // Vérifier que l'utilisateur existe
            if (!Utilisateur::find($row['utilisateur_id'])) {
                echo "Utilisateur introuvable pour la ligne : {$row['code']}\n";
                continue;
            }

            // Éviter les doublons
            if (LigneBudgetaire::where('code', $row['code'])->exists()) {
                continue;
            }

            LigneBudgetaire::create([

                'code' => trim($row['code']),

                'intitule' => trim($row['intitule']),

                'annee' => (int) $row['annee'],

                'type' => trim($row['type']),

                'client' => trim($row['client']),

                'date_objective' => Date::excelToDateTimeObject($row['date_objective'])->format('Y-m-d'),

                'montant_estimatif' => $this->convertMontant($row['montant_estimatif']),

                'utilisateur_id' => $row['utilisateur_id'],

                'statut' => strtolower(trim($row['statut']))
            ]);
        }
    }

    /**
     * Convertir une date française
     */
    private function convertDate($date)
    {
        try {

            return Carbon::parse($date)->format('Y-m-d');

        } catch (\Exception $e) {

            return null;
        }
    }

    /**
     * Convertir un montant
     */
    private function convertMontant($montant)
    {
        $montant = str_replace(' ', '', $montant);
        $montant = str_replace(',', '.', $montant);

        return (float) $montant;
    }
}