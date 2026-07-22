<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportTravaux extends Model
{
    protected $table = 'rapport_travaux';

    protected $fillable = [
        'code',
        'commande_id',
        'date',
        'cin_reporteur',
        'meteo_matin',
        'meteo_soir',
        'ecart_hse',
        'ecart_qualite',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function rapportActivites()
    {
        return $this->hasMany(RapportActivite::class);
    }

    public function nonConformites()
    {
        return $this->hasMany(NonConformite::class);
    }
}