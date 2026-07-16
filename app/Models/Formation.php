<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'code',
        'personnel_cin',
        'date',
        'theme',
        'animateur',
        'score',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_cin', 'cin');
    }
}