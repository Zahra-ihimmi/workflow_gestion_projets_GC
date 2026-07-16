<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{

    public function index()
    {
        $vehicules = Vehicule::with('fournisseur')
                    ->orderBy('date_debut','desc')
                    ->paginate(10);

        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('vehicules.create', compact('fournisseurs'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'fournisseur_id' => 'required',

            'type' => 'required',

            'type_habilitation' => 'required',

            'date_debut' => 'required|date',

            'date_fin' => 'nullable|date|after_or_equal:date_debut',

        ]);

        Vehicule::create([

            'fournisseur_id' => $request->fournisseur_id,

            'type' => $request->type,

            'type_habilitation' => $request->type_habilitation,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

        ]);

        return redirect()->route('vehicules.index');

    }

    public function edit($id)
    {

        $vehicule = Vehicule::find($id);

        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('vehicules.edit', compact(
            'vehicule',
            'fournisseurs'
        ));

    }

    public function update(Request $request,$id)
    {

        $request->validate([

            'fournisseur_id' => 'required',

            'type' => 'required',

            'type_habilitation' => 'required',

            'date_debut' => 'required|date',

            'date_fin' => 'nullable|date|after_or_equal:date_debut',

        ]);

        $vehicule = Vehicule::find($id);

        $vehicule->update([

            'fournisseur_id' => $request->fournisseur_id,

            'type' => $request->type,

            'type_habilitation' => $request->type_habilitation,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

        ]);

        return redirect()->route('vehicules.index');

    }

    public function destroy($id)
    {

        Vehicule::find($id)->delete();

        return redirect()->route('vehicules.index');

    }

}