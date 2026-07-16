<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decompte extends Model
{
    protected $fillable = [

        'code',

        'commande_id',

        'date',

        'designation',

        'quantite_attachee',

        'num_ses',

        'num_rec_ses',

        'statut_validation',

    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}