<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'decompte_id',
        'date_depot',
        'date_echeance',
        'montant',
    ];

    public function decompte()
    {
        return $this->belongsTo(Decompte::class);
    }
}