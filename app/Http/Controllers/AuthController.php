<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Afficher la page de connexion.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion.
     */
    public function login(Request $request)
    {
        // Validation des champs
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ], [
            'email.required' => 'Veuillez saisir votre adresse email.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'password.required' => 'Veuillez saisir votre mot de passe.',
        ]);

        // Vérification des identifiants
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            // Régénérer la session pour éviter les attaques de fixation de session
            $request->session()->regenerate();

            // Redirection vers la page initialement demandée
            return redirect()->intended('/dashboard/strategique');
        }

        // Identifiants incorrects
        return back()
            ->withErrors([
                'email' => 'L’adresse email ou le mot de passe est incorrect.',
            ])
            ->withInput($request->only('email'));
    }

    /**
     * Déconnecter l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalider la session actuelle
        $request->session()->invalidate();

        // Générer un nouveau token CSRF
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
}