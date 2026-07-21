<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportActivite extends Model
{
    protected $fillable = [
        'rapport_travaux_id',
        'prix_id',
        'activite',
        'avancement',
    ];

    public function rapportTravaux()
    {
        return $this->belongsTo(
            RapportTravaux::class,
            'rapport_travaux_id'
        );
    }

    public function prix()
    {
        return $this->belongsTo(
            Prix::class,
            'prix_id'
        );
    }
}