<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\DemandeAchat;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with([
            'fournisseur',
            'demandeAchat'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::all();

        $demandeAchats = DemandeAchat::all();


        return view('commandes.create', compact(
            'fournisseurs',
            'demandeAchats'
        ));
    }

    public function store(Request $request)
    {

        $annee = date('Y');


        $dernierCode = Commande::whereYear('created_at', $annee)
                        ->orderBy('id','desc')
                        ->first();


        if($dernierCode)
        {
            $numero = intval(substr($dernierCode->code, -3)) + 1;
        }
        else
        {
            $numero = 1;
        }


        $code = 'CMD-' . $annee . '-' . str_pad($numero,3,'0',STR_PAD_LEFT);



        Commande::create([

            'code' => $code,

            'fournisseur_id' => $request->fournisseur_id,

            'demande_achat_id' => $request->demande_achat_id,

            'date_os' => $request->date_os,

            'duree_travaux' => $request->duree_travaux,

            'classe_hse' => $request->classe_hse,

            'montant_ht' => $request->montant_ht,

            'mode_facturation' => $request->mode_facturation,

            'mode_paiement' => $request->mode_paiement,

            'duree_garantie' => $request->duree_garantie,

            'complexite' => $request->complexite,

            'statut' => $request->statut,

        ]);


        return redirect()->route('commandes.index');

    }

    public function edit($id)
    {
        $commande = Commande::find($id);

        $fournisseurs = Fournisseur::all();

        $demandeAchats = DemandeAchat::all();


        return view('commandes.edit', compact(
            'commande',
            'fournisseurs',
            'demandeAchats'
        ));
    }

public function update(Request $request, $id)
{

    $commande = Commande::find($id);


    $commande->update([

        'code' => $request->code,

        'fournisseur_id' => $request->fournisseur_id,

        'demande_achat_id' => $request->demande_achat_id,

        'date_os' => $request->date_os,

        'duree_travaux' => $request->duree_travaux,

        'classe_hse' => $request->classe_hse,

        'montant_ht' => $request->montant_ht,

        'mode_facturation' => $request->mode_facturation,

        'mode_paiement' => $request->mode_paiement,

        'duree_garantie' => $request->duree_garantie,

        'complexite' => $request->complexite,

        'statut' => $request->statut,

    ]);


    return redirect()->route('commandes.index');

}

public function destroy($id)
{
    $commande = Commande::find($id);

    $commande->delete();

    return redirect()->route('commandes.index');
}

}