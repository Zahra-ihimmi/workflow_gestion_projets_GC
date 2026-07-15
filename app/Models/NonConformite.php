<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonConformite extends Model
{
    protected $fillable = [
        'rapport_travaux_id',
        'personnel_cin',
        'date',
        'classe',
        'type',
        'description',
        'plan_action',
        'echeance',
    ];

    public function rapportTravaux()
    {
        return $this->belongsTo(RapportTravaux::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_cin', 'cin');
    }
}