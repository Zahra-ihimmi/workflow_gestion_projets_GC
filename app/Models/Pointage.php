<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    protected $fillable = [
        'code',
        'personnel_cin',
        'date',
        'nb_heure',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_cin', 'cin');
    }
}