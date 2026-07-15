<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'type',
        'type_habilitation',
        'date_debut',
        'date_fin',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}