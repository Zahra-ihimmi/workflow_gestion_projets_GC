<?php

namespace App\Http\Controllers;

use App\Models\DemandeAchat;
use Illuminate\Http\Request;

class DemandeAchatController extends Controller
{
    public function index()
    {
        $demandeAchats = DemandeAchat::with([
            'ligneBudgetaire',
            'utilisateur'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('demande_achats.index', compact('demandeAchats'));
    }

    public function create()
    {
        return view('demande_achats.create');
    }

    public function store(Request $request)
    {

        DemandeAchat::create([

            'code' => $request->code,

            'ligne_budgetaire_id' => $request->ligne_budgetaire_id,

            'utilisateur_id' => $request->utilisateur_id,

            'estimation' => $request->estimation,

            'date_saisi' => $request->date_saisi,

            'acheteur' => $request->acheteur,

            'type_projet' => $request->type_projet,

            'categorie' => $request->categorie,

            'statut' => $request->statut,

        ]);


        return redirect()->route('demande-achats.index');

    }

    public function edit($id)
    {

        $demandeAchat = DemandeAchat::find($id);


        return view('demande_achats.edit', compact('demandeAchat'));

    }

    public function update(Request $request, $id)
    {

        $demandeAchat = DemandeAchat::find($id);


        $demandeAchat->update([

            'code' => $request->code,

            'ligne_budgetaire_id' => $request->ligne_budgetaire_id,

            'utilisateur_id' => $request->utilisateur_id,

            'estimation' => $request->estimation,

            'date_saisi' => $request->date_saisi,

            'acheteur' => $request->acheteur,

            'type_projet' => $request->type_projet,

            'categorie' => $request->categorie,

            'statut' => $request->statut,

        ]);


        return redirect()->route('demande-achats.index');

    }

    public function destroy($id)
    {
        $demandeAchat = DemandeAchat::find($id);

        $demandeAchat->delete();

        return redirect()->route('demande-achats.index');
    }


    
    }
