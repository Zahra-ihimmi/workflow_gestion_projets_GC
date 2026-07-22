<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonConformite extends Model
{
    protected $fillable = [

        'code',

        'commande_id',

        'date',

        'classe',

        'type',
        'description',

        'echeance',

        'personnel_cin',

    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function personnel()
    {
        return $this->belongsTo(
            Personnel::class,
            'personnel_cin',
            'cin'
        );
    }

    public function planActions()
    {
        return $this->hasMany(PlanAction::class);
    }
}