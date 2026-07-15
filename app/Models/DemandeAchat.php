<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    protected $fillable = [
        'ligne_budgetaire_id',
        'estimation',
        'acheteur',
        'acheteur_hc',
        'lead_achat',
        'date_saisie',
        'type_projet',
        'categorie',
        'statut',
    ];

    public function ligneBudgetaire()
    {
        return $this->belongsTo(LigneBudgetaire::class);
    }

    public function commande()
    {
        return $this->hasOne(Commande::class);
    }
}