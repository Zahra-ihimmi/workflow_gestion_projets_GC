<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{

    // Liste
    public function index()
    {
        $personnels = Personnel::with('fournisseur')
                    ->orderBy('nom')
                    ->get();

        return view('personnels.index', compact('personnels'));
    }

    // Formulaire ajout
    public function create()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('personnels.create', compact('fournisseurs'));
    }

    // Enregistrer
    public function store(Request $request)
    {

        $request->validate([

            'cin' => 'required|unique:personnels,cin',

            'fournisseur_id' => 'required',

            'nom' => 'required',

            'prenom' => 'required',

            'fonction' => 'required',

            'photo' => 'nullable',

            'type_contrat' => 'required',

            'pne' => 'nullable',

            'niveau' => 'nullable',

            'date_debut' => 'nullable|date',

            'date_fin' => 'nullable|date',

        ]);

        Personnel::create([

            'cin' => $request->cin,

            'fournisseur_id' => $request->fournisseur_id,

            'nom' => $request->nom,

            'prenom' => $request->prenom,

            'fonction' => $request->fonction,

            'photo' => $request->photo,

            'type_contrat' => $request->type_contrat,

            'pne' => $request->pne,

            'niveau' => $request->niveau,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

        ]);

        return redirect()->route('personnels.index');

    }

    // Formulaire modification
    public function edit($id)
    {

        $personnel = Personnel::find($id);

        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('personnels.edit', compact(
            'personnel',
            'fournisseurs'
        ));

    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'cin' => 'required|unique:personnels,cin,'.$id,

            'fournisseur_id' => 'required',

            'nom' => 'required',

            'prenom' => 'required',

            'fonction' => 'required',

            'photo' => 'nullable',

            'type_contrat' => 'required',

            'pne' => 'nullable',

            'niveau' => 'nullable',

            'date_debut' => 'nullable|date',

            'date_fin' => 'nullable|date',

        ]);

        $personnel = Personnel::find($id);

        $personnel->update([

            'cin' => $request->cin,

            'fournisseur_id' => $request->fournisseur_id,

            'nom' => $request->nom,

            'prenom' => $request->prenom,

            'fonction' => $request->fonction,

            'photo' => $request->photo,

            'type_contrat' => $request->type_contrat,

            'pne' => $request->pne,

            'niveau' => $request->niveau,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

        ]);

        return redirect()->route('personnels.index');

    }

    // Supprimer
    public function destroy($id)
    {

        $personnel = Personnel::find($id);

        $personnel->delete();

        return redirect()->route('personnels.index');

    }

}