<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = [
        'code',
        'prix_id',
        'designation',
        'date_debut',
        'date_fin_prevue',
        'date_debut_reelle',
    ];

    public function prix()
    {
        return $this->belongsTo(Prix::class);
    }
}