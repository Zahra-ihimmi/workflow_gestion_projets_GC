<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
        'id_ariba',
        'nom',
        'logo',
        'lien_web',
    ];

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }

    public function assurances()
    {
        return $this->hasMany(Assurance::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}