<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'code',
        'decompte_id',
        'date_depot',
        'montant',
    ];

    public function decompte()
    {
        return $this->belongsTo(Decompte::class);
    }
}