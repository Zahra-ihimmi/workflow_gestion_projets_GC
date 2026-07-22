<?php

namespace App\Http\Controllers;

use App\Models\Decompte;
use App\Models\Commande;
use Illuminate\Http\Request;

class DecompteController extends Controller
{

    public function index()
    {
        $decomptes = Decompte::with('commande')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('decomptes.index', compact('decomptes'));
    }

    public function create()
    {
        $commandes = Commande::all();

        return view('decomptes.create', compact('commandes'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'commande_id'=>'required',

            'date'=>'required',

            'designation'=>'required',

            'quantite_attachee'=>'required|numeric|min:0',

            'statut_validation'=>'required',

        ]);


        $annee = date('Y');

        $dernier = Decompte::latest()->first();

        if($dernier)
        {
            $numero = intval(substr($dernier->code,-3))+1;
        }
        else
        {
            $numero=1;
        }

        $code='DEC-'.$annee.'-'.str_pad($numero,3,'0',STR_PAD_LEFT);


        Decompte::create([

            'code'=>$code,

            'commande_id'=>$request->commande_id,

            'date'=>$request->date,

            'designation'=>$request->designation,

            'quantite_attachee'=>$request->quantite_attachee,

            'num_ses'=>$request->num_ses,

            'num_rec_ses'=>$request->num_rec_ses,

            'statut_validation'=>$request->statut_validation,

        ]);


        return redirect()->route('decomptes.index');

    }

    public function edit($id)
    {
        $decompte = Decompte::find($id);

        $commandes = Commande::all();

        return view('decomptes.edit', compact(
            'decompte',
            'commandes'
        ));
    }
    
    public function update(Request $request, $id)
    {

    $request->validate([

        'commande_id' => 'required',

        'date' => 'required',

        'designation' => 'required',

        'quantite_attachee' => 'required|numeric|min:0',

        'statut_validation' => 'required',

    ]);


    $decompte = Decompte::find($id);

    $decompte->update([

        'commande_id' => $request->commande_id,

        'date' => $request->date,

        'designation' => $request->designation,

        'quantite_attachee' => $request->quantite_attachee,

        'num_ses' => $request->num_ses,

        'num_rec_ses' => $request->num_rec_ses,

        'statut_validation' => $request->statut_validation,

    ]);

    return redirect()->route('decomptes.index');

}

public function destroy($id)
{
    $decompte = Decompte::find($id);

    $decompte->delete();

    return redirect()->route('decomptes.index');
}


}