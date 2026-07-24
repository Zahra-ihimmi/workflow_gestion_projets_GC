<?php

namespace App\Http\Controllers;

use App\Models\LigneBudgetaire;
use Illuminate\Http\Request;
use App\Models\Utilisateur;

class LigneBudgetaireController extends Controller
{
    /**
     * Afficher la liste des lignes budgétaires.
     */
    public function index()
    {
        $ligneBudgetaires = LigneBudgetaire::with('utilisateur')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('ligne_budgetaires.index', compact('ligneBudgetaires'));
    }

    public function create()
    {
        $utilisateurs = Utilisateur::all();

        return view('ligne_budgetaires.create', compact('utilisateurs'));
    }

    public function store(Request $request)
    {

        $code = 'OIJ-IV' . date('Y') . '-' . rand(10000, 99999);

        LigneBudgetaire::create([
            'utilisateur_id' => $request->utilisateur_id,
            'code' => $code,
            'intitule' => $request->intitule,
            'annee' => $request->annee,
            'type' => $request->type,
            'client' => $request->client,
            'date_objective' => $request->date_objective,
            'montant_estimatif' => $request->montant_estimatif,
            'statut' => $request->statut,
        ]);


        return redirect()
            ->route('ligne-budgetaires.index')
            ->with('success', 'Ligne budgétaire ajoutée avec succès');

    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit($id)
    {
        $ligneBudgetaire = LigneBudgetaire::findOrFail($id);

        $utilisateurs = Utilisateur::all();

        return view('ligne_budgetaires.edit', compact(
            'ligneBudgetaire',
            'utilisateurs'
        ));
    }


    /**
     * Mettre à jour une ligne budgétaire
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'intitule' => 'required',
            'annee' => 'required|integer',
            'type' => 'required',
            'client' => 'required',
            'date_objective' => 'required|date',
            'montant_estimatif' => 'required|numeric',
            'statut' => 'required',
        ]);


        $ligneBudgetaire = LigneBudgetaire::findOrFail($id);


        $ligneBudgetaire->update([
            'intitule' => $request->intitule,
            'annee' => $request->annee,
            'type' => $request->type,
            'client' => $request->client,
            'date_objective' => $request->date_objective,
            'montant_estimatif' => $request->montant_estimatif,
            'statut' => $request->statut,
        ]);


        return redirect()
        ->route('ligne-budgetaires.index') 
        ->with('success', 'Ligne budgétaire modifiée avec succès');
    }

    /**
 * Supprimer une ligne budgétaire
 */
    public function destroy($id)
    {
        $ligneBudgetaire = LigneBudgetaire::findOrFail($id);

        $ligneBudgetaire->delete();

        return redirect()
            ->route('ligne-budgetaires.index')
            ->with('success', 'Ligne budgétaire supprimée avec succès');
    }
    }