<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [

        'cin',

        'fournisseur_id',

        'nom',

        'prenom',

        'fonction',

        'photo',

        'type_contrat',

        'pne',

        'niveau',

        'date_debut',

        'date_fin',

    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function habilitations()
    {
        return $this->hasMany(Habilitation::class);
    }

    public function pointages()
    {
        return $this->hasMany(
            Pointage::class,
            'personnel_cin',
            'cin'
        );
    }
}