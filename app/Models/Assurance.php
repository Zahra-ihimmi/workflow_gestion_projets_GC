<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'type',
        'police',
        'date_debut',
        'date_fin',
        'quittance',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}