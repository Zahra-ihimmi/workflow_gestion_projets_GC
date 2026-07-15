<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'motdepasse',
    ];

    public function ligneBudgetaires()
    {
        return $this->hasMany(LigneBudgetaire::class);
    }
}