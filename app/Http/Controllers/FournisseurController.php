<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{

    // Liste
    public function index()
    {
        $fournisseurs = Fournisseur::orderBy('nom')
                        ->paginate(10);

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    // Formulaire ajout
    public function create()
    {
        return view('fournisseurs.create');
    }

    // Enregistrer
    public function store(Request $request)
    {

        $request->validate([

            'id_ariba' => 'required|unique:fournisseurs,id_ariba',

            'nom' => 'required',

            'logo' => 'nullable',

            'lien_web' => 'nullable|url',

        ]);

        Fournisseur::create([

            'id_ariba' => $request->id_ariba,

            'nom' => $request->nom,

            'logo' => $request->logo,

            'lien_web' => $request->lien_web,

        ]);

        return redirect()->route('fournisseurs.index');

    }

    // Formulaire modification
    public function edit($id)
    {

        $fournisseur = Fournisseur::find($id);

        return view('fournisseurs.edit', compact('fournisseur'));

    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'id_ariba' => 'required|unique:fournisseurs,id_ariba,'.$id,

            'nom' => 'required',

            'logo' => 'nullable',

            'lien_web' => 'nullable|url',

        ]);

        $fournisseur = Fournisseur::find($id);

        $fournisseur->update([

            'id_ariba' => $request->id_ariba,

            'nom' => $request->nom,

            'logo' => $request->logo,

            'lien_web' => $request->lien_web,

        ]);

        return redirect()->route('fournisseurs.index');

    }

    // Supprimer
    public function destroy($id)
    {

        $fournisseur = Fournisseur::find($id);

        $fournisseur->delete();

        return redirect()->route('fournisseurs.index');

    }

}