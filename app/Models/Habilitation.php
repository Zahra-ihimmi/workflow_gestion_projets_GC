<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilitation extends Model
{
    protected $fillable = [
        'personnel_cin',
        'type',
        'date_obtention',
        'duree_habilitation',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_cin', 'cin');
    }
}