<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    protected $fillable = [

        'code',

        'ligne_budgetaire_id',

        'utilisateur_id',

        'estimation',

        'date_saisi',

        'acheteur',

        'type_projet',

        'categorie',

        'statut',

    ];

    public function ligneBudgetaire()
    {
        return $this->belongsTo(LigneBudgetaire::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function commande()
        {
            return $this->hasOne(Commande::class);
        }
}