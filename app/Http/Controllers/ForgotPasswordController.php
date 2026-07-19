<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Afficher le formulaire "Mot de passe oublié".
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envoyer le lien de réinitialisation.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ], [
            'email.required' => 'Veuillez saisir votre adresse email.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
        ]);

        // Vérifier que l'utilisateur existe
        $utilisateur = Utilisateur::where(
            'email',
            $request->email
        )->first();

        if (!$utilisateur) {
            return back()
                ->withErrors([
                    'email' => 'Aucun utilisateur ne correspond à cette adresse email.',
                ])
                ->withInput();
        }

        // Générer un token
        $token = Str::random(64);

        // Supprimer un ancien token éventuel
        \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Enregistrer le nouveau token
        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Pour l'instant, redirection vers la page de reset
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ])->with('status', 'Vous pouvez maintenant définir un nouveau mot de passe.');
    }

    /**
     * Afficher le formulaire de nouveau mot de passe.
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Réinitialiser le mot de passe.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ], [
            'email.required' => 'Veuillez saisir votre adresse email.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'password.required' => 'Veuillez saisir un nouveau mot de passe.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Récupérer le token
        $reset = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$reset) {
            return back()->withErrors([
                'email' => 'Le lien de réinitialisation est invalide ou a expiré.',
            ]);
        }

        // Vérifier le token
        if (!Hash::check($request->token, $reset->token)) {
            return back()->withErrors([
                'email' => 'Le lien de réinitialisation est invalide.',
            ]);
        }

        // Vérifier l'expiration du token
        if (
            now()->diffInMinutes(
                $reset->created_at
            ) > 60
        ) {
            return back()->withErrors([
                'email' => 'Le lien de réinitialisation a expiré.',
            ]);
        }

        // Récupérer l'utilisateur
        $utilisateur = Utilisateur::where(
            'email',
            $request->email
        )->first();

        if (!$utilisateur) {
            return back()->withErrors([
                'email' => 'Utilisateur introuvable.',
            ]);
        }

        // Mettre à jour le mot de passe
        $utilisateur->motdepasse = Hash::make(
            $request->password
        );

        $utilisateur->save();

        // Supprimer le token après utilisation
        \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.'
            );
    }
}