<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Prix;
use Illuminate\Http\Request;

class PlanningController extends Controller
{

    // Liste
    public function index()
    {
        $plannings = Planning::with('prix')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('plannings.index',compact('plannings'));
    }

    // Formulaire ajout
    public function create()
    {
        $prix = Prix::all();

        return view('plannings.create',compact('prix'));
    }

    // Enregistrer
    public function store(Request $request)
    {

        $request->validate([

            'prix_id'=>'required|unique:plannings,prix_id',

            'designation'=>'required',

            'date_debut'=>'required|date',

            'date_fin_prevue'=>'required|date|after_or_equal:date_debut',

            'date_debut_reelle'=>'nullable|date',

        ]);


        $annee=date('Y');

        $dernier=Planning::latest()->first();

        if($dernier)
        {
            $numero=intval(substr($dernier->code,-3))+1;
        }
        else
        {
            $numero=1;
        }

        $code='PLN-'.$annee.'-'.str_pad($numero,3,'0',STR_PAD_LEFT);


        Planning::create([

            'code'=>$code,

            'prix_id'=>$request->prix_id,

            'designation'=>$request->designation,

            'date_debut'=>$request->date_debut,

            'date_fin_prevue'=>$request->date_fin_prevue,

            'date_debut_reelle'=>$request->date_debut_reelle,

        ]);

        return redirect()
    ->route('plannings.index')
    ->with('success', 'Planning ajouté avec succès');

    }

    // Formulaire modification
    public function edit($id)
    {
        $planning=Planning::find($id);

        $prix=Prix::all();

        return view('plannings.edit',compact(
            'planning',
            'prix'
        ));
    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'prix_id'=>'required|unique:plannings,prix_id,'.$id,

            'designation'=>'required',

            'date_debut'=>'required|date',

            'date_fin_prevue'=>'required|date|after_or_equal:date_debut',

            'date_debut_reelle'=>'nullable|date',

        ]);

        $planning=Planning::find($id);

        $planning->update([

            'prix_id'=>$request->prix_id,

            'designation'=>$request->designation,

            'date_debut'=>$request->date_debut,

            'date_fin_prevue'=>$request->date_fin_prevue,

            'date_debut_reelle'=>$request->date_debut_reelle,

        ]);

        return redirect()
            ->route('plannings.index')
            ->with('success', 'Planning mis à jour avec succès');

    }

    // Supprimer
    public function destroy($id)
    {
        $planning=Planning::find($id);

        $planning->delete();

        return redirect()->route('plannings.index');
    }

}