<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{

    public function index()
    {
        $assurances = Assurance::with('fournisseur')
                        ->orderBy('date_fin')
                        ->paginate(10);

        return view('assurances.index', compact('assurances'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('assurances.create', compact('fournisseurs'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'fournisseur_id' => 'required',

            'type' => 'required',

            'police' => 'required|unique:assurances,police',

            'date_debut' => 'required|date',

            'date_fin' => 'required|date|after_or_equal:date_debut',

            'quittance' => 'nullable',

        ]);

        Assurance::create([

            'fournisseur_id' => $request->fournisseur_id,

            'type' => $request->type,

            'police' => $request->police,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

            'quittance' => $request->quittance,

        ]);

        return redirect()->route('assurances.index');

    }

    public function edit($id)
    {

        $assurance = Assurance::find($id);

        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('assurances.edit', compact(
            'assurance',
            'fournisseurs'
        ));

    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'fournisseur_id' => 'required',

            'type' => 'required',

            'police' => 'required|unique:assurances,police,' . $id,

            'date_debut' => 'required|date',

            'date_fin' => 'required|date|after_or_equal:date_debut',

            'quittance' => 'nullable',

        ]);

        $assurance = Assurance::find($id);

        $assurance->update([

            'fournisseur_id' => $request->fournisseur_id,

            'type' => $request->type,

            'police' => $request->police,

            'date_debut' => $request->date_debut,

            'date_fin' => $request->date_fin,

            'quittance' => $request->quittance,

        ]);

        return redirect()->route('assurances.index');

    }

    public function destroy($id)
    {

        Assurance::find($id)->delete();

        return redirect()->route('assurances.index');

    }

}