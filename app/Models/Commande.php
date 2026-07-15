<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'demande_achat_id',
        'date_os',
        'duree_travaux',
        'classe_hse',
        'montant_ht',
        'mode_facturation',
        'mode_paiement',
        'duree_garantie',
        'complexite',
        'statut',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function demandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class);
    }

    public function prix()
    {
        return $this->hasMany(Prix::class);
    }

    public function decomptes()
    {
        return $this->hasMany(Decompte::class);
    }

    public function rapportTravaux()
    {
        return $this->hasMany(RapportTravaux::class);
    }

    public function planActions()
    {
        return $this->hasMany(PlanAction::class);
    }
}