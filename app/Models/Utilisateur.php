<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'motdepasse',
    ];

    protected $hidden = [
        'motdepasse',
        'remember_token',
    ];

    /**
     * Mot de passe utilisé par Laravel pour l'authentification.
     */
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    /**
     * Email utilisé pour la réinitialisation du mot de passe.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function ligneBudgetaires()
    {
        return $this->hasMany(LigneBudgetaire::class);
    }
}