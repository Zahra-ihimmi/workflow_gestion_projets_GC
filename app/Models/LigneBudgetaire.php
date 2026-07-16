<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneBudgetaire extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'code',
        'intitule',
        'annee',
        'type',
        'client',
        'date_objective',
        'montant_estimatif',
        'statut',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function demandeAchat()
    {
        return $this->hasMany(DemandeAchat::class);
    }
    
}