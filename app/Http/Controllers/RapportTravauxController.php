<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\RapportTravaux;
use Illuminate\Http\Request;

class RapportTravauxController extends Controller
{
    // Liste
    public function index()
    {
        $rapports = RapportTravaux::with('commande')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rapport_travaux.index', compact('rapports'));
    }

    // Formulaire ajout
    public function create()
    {
        $commandes = Commande::all();

        return view('rapport_travaux.create', compact('commandes'));
    }

    // Enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required',
            'date' => 'required|date',
            'ecart_hse' => 'required',
            'ecart_qualite' => 'required',
        ]);

        $annee = date('Y');

        $dernier = RapportTravaux::latest()->first();

        if ($dernier) {
            $numero = intval(substr($dernier->code, -3)) + 1;
        } else {
            $numero = 1;
        }

        $code = 'RPT-' . $annee . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        RapportTravaux::create([
            'code' => $code,
            'commande_id' => $request->commande_id,
            'date' => $request->date,
            'ecart_hse' => $request->ecart_hse,
            'ecart_qualite' => $request->ecart_qualite,
        ]);

        return redirect()->route('rapport-travaux.index');
    }

    // Formulaire modification
    public function edit($id)
    {
        $rapport = RapportTravaux::find($id);

        $commandes = Commande::all();

        return view('rapport_travaux.edit', compact(
            'rapport',
            'commandes'
        ));
    }

    // Modifier
    public function update(Request $request, $id)
    {
        $request->validate([
            'commande_id' => 'required',
            'date' => 'required|date',
            'ecart_hse' => 'required',
            'ecart_qualite' => 'required',
        ]);

        $rapport = RapportTravaux::find($id);

        $rapport->update([
            'commande_id' => $request->commande_id,
            'date' => $request->date,
            'ecart_hse' => $request->ecart_hse,
            'ecart_qualite' => $request->ecart_qualite,
        ]);

        return redirect()->route('rapport-travaux.index');
    }

    // Supprimer
    public function destroy($id)
    {
        $rapport = RapportTravaux::find($id);

        $rapport->delete();

        return redirect()->route('rapport-travaux.index');
    }
}