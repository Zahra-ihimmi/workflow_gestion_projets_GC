<?php

namespace App\Imports;

use App\Models\Commande;
use App\Models\DemandeAchat;
use App\Models\Fournisseur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CommandeImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Ignorer les lignes vides
            if (empty($row['code'])) {
                continue;
            }

            // Éviter les doublons
            if (Commande::where('code', $row['code'])->exists()) {
                continue;
            }

            // Vérifier le fournisseur
            if (!Fournisseur::find($row['fournisseur_id'])) {
                echo "Fournisseur introuvable : {$row['fournisseur_id']}\n";
                continue;
            }

            // Vérifier la demande d'achat
            if (!DemandeAchat::find($row['demande_achat_id'])) {
                echo "Demande d'achat introuvable : {$row['demande_achat_id']}\n";
                continue;
            }
            
            
            Commande::create([

                'code' => trim($row['code']),

                'fournisseur_id' => $row['fournisseur_id'],

                'demande_achat_id' => $row['demande_achat_id'],

                'date_os' => Date::excelToDateTimeObject($row['date_os'])->format('Y-m-d'),

                'duree_travaux' => $row['duree_travaux'],

                'classe_hse' => trim($row['classe_hse']),

                'montant_ht' => $this->convertMontant($row['montant_ht']),

                'mode_facturation' => trim($row['mode_facturation']),

                'mode_paiement' => trim($row['mode_paiement']),

                'duree_garantie' => $row['duree_garantie'],

                'complexite' => trim($row['complexite']),

                'statut' => trim($row['statut'])

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