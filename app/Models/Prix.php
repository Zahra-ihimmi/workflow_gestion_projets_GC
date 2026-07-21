<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prix extends Model
{
    protected $table = 'prix';

    protected $fillable = [
        'code',
        'commande_id',
        'designation',
        'quantite',
        'prix_unitaire',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function planning()
    {
        return $this->hasOne(Planning::class);
    }

    public function rapportActivites()
    {
        return $this->hasMany(
            RapportActivite::class,
            'prix_id'
        );
    }
}