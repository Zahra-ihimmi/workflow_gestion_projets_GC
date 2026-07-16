<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Decompte;
use Illuminate\Http\Request;

class FactureController extends Controller
{

    // Liste
    public function index()
    {
        $factures = Facture::with('decompte')
                    ->orderBy('created_at','desc')
                    ->paginate(10);

        return view('factures.index', compact('factures'));
    }

    // Formulaire ajout
    public function create()
    {
        $decomptes = Decompte::all();

        return view('factures.create', compact('decomptes'));
    }

    // Enregistrer
    public function store(Request $request)
    {
        $request->validate([

            'decompte_id' => 'required|unique:factures,decompte_id',

            'date_depot' => 'required|date',

            'montant' => 'required|numeric|min:0',

        ]);


        $annee = date('Y');

        $dernier = Facture::latest()->first();

        if($dernier)
        {
            $numero = intval(substr($dernier->code,-3))+1;
        }
        else
        {
            $numero = 1;
        }

        $code = 'FAC-'.$annee.'-'.str_pad($numero,3,'0',STR_PAD_LEFT);


        Facture::create([

            'code'=>$code,

            'decompte_id'=>$request->decompte_id,

            'date_depot'=>$request->date_depot,

            'montant'=>$request->montant,

        ]);

        return redirect()->route('factures.index');

    }

    // Formulaire modification
    public function edit($id)
    {
        $facture = Facture::find($id);

        $decomptes = Decompte::all();

        return view('factures.edit', compact(
            'facture',
            'decomptes'
        ));
    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'decompte_id'=>'required|unique:factures,decompte_id,'.$id,

            'date_depot'=>'required|date',

            'montant'=>'required|numeric|min:0',

        ]);

        $facture = Facture::find($id);

        $facture->update([

            'decompte_id'=>$request->decompte_id,

            'date_depot'=>$request->date_depot,

            'montant'=>$request->montant,

        ]);

        return redirect()->route('factures.index');

    }

    // Supprimer
    public function destroy($id)
    {
        $facture = Facture::find($id);

        $facture->delete();

        return redirect()->route('factures.index');
    }

}