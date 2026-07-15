<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $primaryKey = 'cin';

    public $incrementing = false;

    protected $keyType = 'string';

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
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class, 'personnel_cin', 'cin');
    }

    public function habilitations()
    {
        return $this->hasMany(Habilitation::class, 'personnel_cin', 'cin');
    }

    public function pointages()
    {
        return $this->hasMany(Pointage::class, 'personnel_cin', 'cin');
    }

    public function planActions()
    {
        return $this->hasMany(PlanAction::class, 'personnel_cin', 'cin');
    }

    public function nonConformites()
    {
        return $this->hasMany(NonConformite::class, 'personnel_cin', 'cin');
    }
}