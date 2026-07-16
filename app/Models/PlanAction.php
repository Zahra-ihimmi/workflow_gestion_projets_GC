<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanAction extends Model
{
    protected $fillable = [
        'code',
        'commande_id',
        'personnel_cin',
        'date_spa',
        'activite',
        'dangers',
        'mesures_preventives',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_cin', 'cin');
    }
}