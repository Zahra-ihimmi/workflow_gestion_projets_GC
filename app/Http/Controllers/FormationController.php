<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Personnel;
use App\Models\Utilisateur;
use App\Notifications\ApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FormationController extends Controller
{

    // Liste
    public function index()
    {
        $formations = Formation::with('personnel')
                        ->orderBy('date','desc')
                        ->get();

        return view('formations.index', compact('formations'));
    }

    // Formulaire ajout
    public function create()
    {
        $personnels = Personnel::orderBy('nom')->get();

        return view('formations.create', compact('personnels'));
    }

    // Enregistrer
    public function store(Request $request)
    {

        $request->validate([

            'personnel_cin' => 'required',

            'date' => 'required|date',

            'theme' => 'required',

            'animateur' => 'required',

            'score' => 'required|numeric|min:0|max:100',

        ]);

        // Génération automatique FOR-001

        $dernierNumero = Formation::get()
            ->map(function ($item) {
                return (int) substr($item->code, -3);
            })
            ->max();

        $numero = $dernierNumero ? $dernierNumero + 1 : 1;

        $code = 'FOR-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        Formation::create([

            'code' => $code,

            'personnel_cin' => $request->personnel_cin,

            'date' => $request->date,

            'theme' => $request->theme,

            'animateur' => $request->animateur,

            'score' => $request->score,

        ]);

       return redirect()
    ->route('formations.index')
    ->with('success', 'Formation ajoutée avec succès');

    }

    // Formulaire modification
    public function edit($id)
    {

        $formation = Formation::find($id);

        $personnels = Personnel::orderBy('nom')->get();

        return view('formations.edit', compact(
            'formation',
            'personnels'
        ));

    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'personnel_cin' => 'required',

            'date' => 'required|date',

            'theme' => 'required',

            'animateur' => 'required',

            'score' => 'required|numeric|min:0|max:100',

        ]);

        $formation = Formation::find($id);

        $formation->update([

            'personnel_cin' => $request->personnel_cin,

            'date' => $request->date,

            'theme' => $request->theme,

            'animateur' => $request->animateur,

            'score' => $request->score,

        ]);

        return redirect()
            ->route('formations.index')
            ->with('success', 'Formation mise à jour avec succès');

    }

    // Supprimer
    public function destroy($id)
    {

        $formation = Formation::find($id);

        $formation->delete();

        return redirect()->route('formations.index');

    }

    public function createExterne()
    {
        $personnels = Personnel::all();

        return view(
            'formations.create-externe',
            compact('personnels')
        );
    }
    public function storeExterne(Request $request)
    {
        $request->validate([
            'personnel_cin' => 'required|exists:personnels,cin',
            'date' => 'required|date',
            'theme' => 'required|string|max:255',
            'animateur' => 'required|string|max:255',
            'score' => 'nullable|numeric|min:0|max:100',
        ]);

        // Génération automatique du code FOR-001
        $dernierNumero = Formation::get()
            ->map(function ($item) {
                return (int) substr($item->code, -3);
            })
            ->max();

        $numero = $dernierNumero ? $dernierNumero + 1 : 1;

        $code = 'FOR-' . str_pad(
            $numero,
            3,
            '0',
            STR_PAD_LEFT
        );

        // Créer la formation
        $formation = Formation::create([
            'code' => $code,
            'personnel_cin' => $request->personnel_cin,
            'date' => $request->date,
            'theme' => $request->theme,
            'animateur' => $request->animateur,
            'score' => $request->score,
        ]);

        // Récupérer les utilisateurs à notifier
        $utilisateurs = Utilisateur::all();

        // Envoyer la notification
        Notification::send(
            $utilisateurs,
            new ApplicationNotification(
                'Nouvelle formation',
                'La formation ' . $formation->code .
                ' a été enregistrée depuis un formulaire externe.',
                'formation',
                route('formations.index', [
                    'highlight' => $formation->id
                ])
            )
        );

        return redirect()
            ->route('externe.formations.create')
            ->with(
                'success',
                'La formation a été enregistrée avec succès.'
            );
    }


}