<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decompte extends Model
{
    protected $fillable = [
        'commande_id',
        'date',
        'designation',
        'montant',
        'statut',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}