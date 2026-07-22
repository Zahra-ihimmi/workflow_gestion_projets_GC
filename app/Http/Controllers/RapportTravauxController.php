<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\RapportTravaux;
use Illuminate\Http\Request;
use App\Models\RapportActivite;

class RapportTravauxController extends Controller
{
    // Liste
    public function index()
    {
        $rapports = RapportTravaux::with([
            'commande',
            'rapportActivites.prix'
        ])->get();

        return view('rapport_travaux.index', compact('rapports'));
    }

    // Formulaire ajout
    public function create()
    {
        $commandes = Commande::with('prix')->get();

        return view('rapport_travaux.create', compact('commandes'));
    }

    // Enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'date' => 'required|date',
            'cin_reporteur' => 'required|string|max:20',
            'meteo_matin' => 'nullable|string|max:255',
            'meteo_soir' => 'nullable|string|max:255',
            'ecart_hse' => 'required',
            'ecart_qualite' => 'required',

            // Validation des activités
            'activites' => 'required|array|min:1',

            'activites.*.prix_id' =>
                'required|exists:prix,id',

            'activites.*.activite' =>
                'required|string',

            'activites.*.avancement' =>
                'required|numeric|min:0|max:100',
        ]);


        // Année actuelle
        $annee = date('Y');


        // Récupérer le dernier rapport
        $dernier = RapportTravaux::latest()->first();


        // Générer le numéro suivant
        if ($dernier) {

            $numero =
                intval(substr($dernier->code, -3)) + 1;

        } else {

            $numero = 1;

        }


        // Générer le code
        $code =
            'RPT-' .
            $annee .
            '-' .
            str_pad(
                $numero,
                3,
                '0',
                STR_PAD_LEFT
            );


        // Créer le rapport de travaux
        $rapport = RapportTravaux::create([

            'code' => $code,

            'commande_id' =>
                $request->commande_id,

            'date' =>
                $request->date,
            'cin_reporteur' => $request->cin_reporteur,
            'meteo_matin' => $request->meteo_matin,
            'meteo_soir' => $request->meteo_soir,
            'ecart_hse' =>
                $request->ecart_hse,

            'ecart_qualite' =>
                $request->ecart_qualite,

        ]);


        // Enregistrer toutes les activités
        foreach ($request->activites as $activite) {

            RapportActivite::create([

                'rapport_travaux_id' =>
                    $rapport->id,

                'prix_id' =>
                    $activite['prix_id'],

                'activite' =>
                    $activite['activite'],

                'avancement' =>
                    $activite['avancement'],

            ]);

        }


        // Retourner vers la liste
        return redirect()
            ->route('rapport-travaux.index')
            ->with(
                'success',
                'Rapport de travaux ajouté avec succès.'
            );
    }

    // Formulaire modification
    public function edit($id)
    {
        $rapport = RapportTravaux::find($id);

        $commandes = Commande::all();

        return view('rapport_travaux.edit', compact(
            'rapport',
            'commandes'
        ));
    }

    // Modifier
    public function update(Request $request, $id)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'date' => 'required|date',
            'cin_reporteur' => 'required|string|max:20',
            'meteo_matin' => 'nullable|string|max:255',
            'meteo_soir' => 'nullable|string|max:255',
            'ecart_hse' => 'required',
            'ecart_qualite' => 'required',
        ]);

        $rapport = RapportTravaux::findOrFail($id);

        $rapport->update([
            'commande_id' => $request->commande_id,
            'date' => $request->date,
            'cin_reporteur' => $request->cin_reporteur,
            'meteo_matin' => $request->meteo_matin,
            'meteo_soir' => $request->meteo_soir,
            'ecart_hse' => $request->ecart_hse,
            'ecart_qualite' => $request->ecart_qualite,
        ]);

        return redirect()
            ->route('rapport-travaux.index')
            ->with(
                'success',
                'Rapport de travaux modifié avec succès.'
            );
    }

    // Supprimer
    public function destroy(RapportTravaux $rapport_travaux)
    {
        // Supprimer manuellement les activités liées au rapport
        \App\Models\RapportActivite::where(
            'rapport_travaux_id',
            $rapport_travaux->id
        )->delete();

        // Supprimer ensuite le rapport de travaux
        $rapport_travaux->delete();

        return redirect()
            ->route('rapport-travaux.index')
            ->with('success', 'Rapport de travaux supprimé avec succès.');
    }

    public function createExterne()
    {
        $commandes = Commande::with('prix')->get();

        return view(
            'rapport_travaux.create-externe',
            compact('commandes')
        );
    }
    public function storeExterne(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'date' => 'required|date',
            'cin_reporteur' => 'required|string|max:20',
            'meteo_matin' => 'nullable|string|max:255',
            'meteo_soir' => 'nullable|string|max:255',
            'ecart_hse' => 'nullable|string',
            'ecart_qualite' => 'nullable|string',

            'activites' => 'required|array|min:1',

            'activites.*.prix_id' =>
                'required|exists:prix,id',

            'activites.*.activite' =>
                'required|string',

            'activites.*.avancement' =>
                'required|numeric|min:0|max:100',
        ]);

        $annee = date('Y');

        $dernier = RapportTravaux::latest()->first();

        if ($dernier) {
            $numero = intval(substr($dernier->code, -3)) + 1;
        } else {
            $numero = 1;
        }

        $code =
            'RPT-' .
            $annee .
            '-' .
            str_pad(
                $numero,
                3,
                '0',
                STR_PAD_LEFT
            );

        $rapport = RapportTravaux::create([
            'code' => $code,
            'commande_id' => $request->commande_id,
            'date' => $request->date,
            'cin_reporteur' => $request->cin_reporteur,
            'meteo_matin' => $request->meteo_matin,
            'meteo_soir' => $request->meteo_soir,
            'ecart_hse' => $request->ecart_hse,
            'ecart_qualite' => $request->ecart_qualite,
        ]);

        foreach ($request->activites as $activite) {

            RapportActivite::create([
                'rapport_travaux_id' => $rapport->id,
                'prix_id' => $activite['prix_id'],
                'activite' => $activite['activite'],
                'avancement' => $activite['avancement'],
            ]);
        }

        return redirect()
            ->route('externe.rapport-journalier')
            ->with(
                'success',
                'Votre rapport journalier a été enregistré avec succès.'
            );
    }

}