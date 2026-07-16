<?php

namespace App\Http\Controllers;

use App\Models\Prix;
use App\Models\Commande;
use Illuminate\Http\Request;

class PrixController extends Controller
{

    // Liste
    public function index()
    {
        $prix = Prix::with('commande')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('prix.index', compact('prix'));
    }

    // Formulaire ajout
    public function create()
    {
        $commandes = Commande::all();

        return view('prix.create', compact('commandes'));
    }

    // Enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required',
            'designation' => 'required',
            'quantite' => 'required|numeric|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $annee = date('Y');

        $dernier = Prix::latest()->first();

        if ($dernier) {
            $numero = intval(substr($dernier->code, -3)) + 1;
        } else {
            $numero = 1;
        }

        $code = 'PRX-' . $annee . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        Prix::create([
            'code' => $code,
            'commande_id' => $request->commande_id,
            'designation' => $request->designation,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('prix.index');
    }

    // Formulaire modification
    public function edit($id)
    {
        $prix = Prix::find($id);

        $commandes = Commande::all();

        return view('prix.edit', compact(
            'prix',
            'commandes'
        ));
    }

    // Modifier
    public function update(Request $request, $id)
    {
        $request->validate([
            'commande_id' => 'required',
            'designation' => 'required',
            'quantite' => 'required|numeric|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $prix = Prix::find($id);

        $prix->update([
            'commande_id' => $request->commande_id,
            'designation' => $request->designation,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('prix.index');
    }

    // Supprimer
    public function destroy($id)
    {
        $prix = Prix::find($id);

        $prix->delete();

        return redirect()->route('prix.index');
    }

}