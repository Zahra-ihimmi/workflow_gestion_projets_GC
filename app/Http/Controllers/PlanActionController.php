<?php

namespace App\Http\Controllers;

use App\Models\PlanAction;
use App\Models\Commande;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PlanActionController extends Controller
{

    // Liste
    public function index()
    {
        $planActions = PlanAction::with('commande','personnel')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('plan_actions.index', compact('planActions'));
    }

    // Formulaire ajout
    public function create()
    {
        $commandes = Commande::all();
        $personnels = Personnel::all();

        return view('plan_actions.create', compact(
            'commandes',
            'personnels'
        ));
    }

    // Enregistrer
    public function store(Request $request)
    {

        $request->validate([

            'commande_id' => 'required',

            'personnel_cin' => 'required',

            'date_spa' => 'required|date',

            'activite' => 'required',

            'dangers' => 'required',

            'mesures_preventives' => 'required',

        ]);

        // Génération automatique SPA-001

        $dernierNumero = PlanAction::get()
            ->map(function ($item) {
                return (int) substr($item->code, -3);
            })
            ->max();

        $numero = $dernierNumero ? $dernierNumero + 1 : 1;

        $code = 'SPA-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        PlanAction::create([

            'code' => $code,

            'commande_id' => $request->commande_id,

            'personnel_cin' => $request->personnel_cin,

            'date_spa' => $request->date_spa,

            'activite' => $request->activite,

            'dangers' => $request->dangers,

            'mesures_preventives' => $request->mesures_preventives,

        ]);

        return redirect()->route('plan-actions.index');

    }

    // Formulaire modification
    public function edit($id)
    {
        $planAction = PlanAction::find($id);

        $commandes = Commande::all();

        $personnels = Personnel::all();

        return view('plan_actions.edit', compact(
            'planAction',
            'commandes',
            'personnels'
        ));
    }

    // Modifier
    public function update(Request $request,$id)
    {

        $request->validate([

            'commande_id'=>'required',

            'personnel_cin'=>'required',

            'date_spa'=>'required|date',

            'activite'=>'required',

            'dangers'=>'required',

            'mesures_preventives'=>'required',

        ]);

        $planAction = PlanAction::find($id);

        $planAction->update([

            'commande_id'=>$request->commande_id,

            'personnel_cin'=>$request->personnel_cin,

            'date_spa'=>$request->date_spa,

            'activite'=>$request->activite,

            'dangers'=>$request->dangers,

            'mesures_preventives'=>$request->mesures_preventives,

        ]);

        return redirect()->route('plan-actions.index');

    }

    // Supprimer
    public function destroy($id)
    {

        $planAction = PlanAction::find($id);

        $planAction->delete();

        return redirect()->route('plan-actions.index');

    }

    public function createExterne()
    {
        $commandes = Commande::all();

        $personnels = Personnel::all();

        return view(
            'plan_actions.create-externe',
            compact('commandes', 'personnels')
        );
    }
    public function storeExterne(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'personnel_cin' => 'required|exists:personnels,cin',
            'date_spa' => 'required|date',
            'activite' => 'required|string|max:255',
            'dangers' => 'required|string|max:255',
            'mesures_preventives' => 'required|string',
        ]);

        PlanAction::create([
            'commande_id' => $request->commande_id,
            'personnel_cin' => $request->personnel_cin,
            'date_spa' => $request->date_spa,
            'activite' => $request->activite,
            'dangers' => $request->dangers,
            'mesures_preventives' => $request->mesures_preventives,
        ]);

        return redirect()
            ->route('externe.plan-actions.create')
            ->with(
                'success',
                'Le plan d\'action a été enregistré avec succès.'
            );
    }

}