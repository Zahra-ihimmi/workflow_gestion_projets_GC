<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Personnel;
use App\Models\NonConformite;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Notifications\ApplicationNotification;
use Illuminate\Support\Facades\Notification;

class NonConformiteController extends Controller
{

    // Liste
    public function index()
    {
        $nonConformites = NonConformite::with('commande','personnel')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('non_conformites.index',compact('nonConformites'));
    }

    // Formulaire ajout
    public function create()
    {
        $commandes = Commande::all();

        $personnels = Personnel::all();

        return view('non_conformites.create',compact(
            'commandes',
            'personnels'
        ));
    }

    // Enregistrer
    public function store(Request $request)
{
    $request->validate([

        'commande_id' => 'required',

        'date' => 'required|date',

        'classe' => 'required',

        'type' => 'required|in:HSE,Qualité',
        'description' => 'required|string',
        'echeance' => 'nullable|date',

        'personnel_cin' => 'required',

    ]);


    // Génération automatique du code

    if ($request->type == "Qualité") {
        $prefixe = "NCQTY";
    } else {
        $prefixe = "NCHSE";
    }

    $dernierNumero = NonConformite::where('code', 'like', $prefixe . '-%')
        ->get()
        ->map(function ($item) {
            return (int) substr($item->code, -3);
        })
        ->max();

    $numero = $dernierNumero ? $dernierNumero + 1 : 1;

    $code = $prefixe . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);


    NonConformite::create([

        'code' => $code,

        'commande_id' => $request->commande_id,

        'date' => $request->date,

        'classe' => $request->classe,

        'type' => $request->type,
        'description' => $request->description,
        'echeance' => $request->echeance,

        'personnel_cin' => $request->personnel_cin,

    ]);

    return redirect()
    ->route('non-conformites.index')
    ->with('success', 'Non-conformité ajoutée avec succès');
}

    // Formulaire modification

    public function edit($id)
    {

        $nonConformite=NonConformite::find($id);

        $commandes=Commande::all();

        $personnels=Personnel::all();

        return view('non_conformites.edit',compact(
            'nonConformite',
            'commandes',
            'personnels'
        ));

    }

    // Modifier

    public function update(Request $request,$id)
    {

        $request->validate([

            'commande_id'=>'required',

            'date'=>'required',

            'classe'=>'required',

            'type' => 'required|in:HSE,Qualité',
            'description' => 'required|string',

            'echeance'=>'nullable',

            'personnel_cin'=>'required',

        ]);

        $nonConformite=NonConformite::find($id);

        $nonConformite->update([

            'commande_id'=>$request->commande_id,

            'date'=>$request->date,

            'classe'=>$request->classe,

            'type'=>$request->type,
            'description' => $request->description,
            'echeance'=>$request->echeance,

            'personnel_cin'=>$request->personnel_cin,

        ]);

        return redirect()
            ->route('non-conformites.index')
            ->with('success', 'Non-conformité mise à jour avec succès');

    }

    // Supprimer

    public function destroy($id)
    {

        $nonConformite=NonConformite::find($id);

        $nonConformite->delete();

        return redirect()->route('non-conformites.index');

    }

    public function createExterne()
    {
        $commandes = Commande::all();

        $personnels = Personnel::all();

        return view(
            'non_conformites.create-externe',
            compact('commandes', 'personnels')
        );
    }
    public function storeExterne(Request $request)
    {
        $request->validate([
            'commande_id' => 'required',
            'date' => 'required|date',
            'classe' => 'required',
            'type' => 'required|in:HSE,Qualité',
            'description' => 'required|string',
            'echeance' => 'nullable|date',
            'personnel_cin' => 'required',
        ]);

        // Génération automatique du code
        if ($request->type == "Qualité") {
            $prefixe = "NCQTY";
        } else {
            $prefixe = "NCHSE";
        }

        $dernierNumero = NonConformite::where(
            'code',
            'like',
            $prefixe . '-%'
        )
        ->get()
        ->map(function ($item) {
            return (int) substr($item->code, -3);
        })
        ->max();

        $numero = $dernierNumero
            ? $dernierNumero + 1
            : 1;

        $code = $prefixe . '-' . str_pad(
            $numero,
            3,
            '0',
            STR_PAD_LEFT
        );


        // Créer la non-conformité
        $nonConformite = NonConformite::create([

            'code' => $code,

            'commande_id' => $request->commande_id,

            'date' => $request->date,

            'classe' => $request->classe,

            'type' => $request->type,

            'description' => $request->description,

            'echeance' => $request->echeance,

            'personnel_cin' => $request->personnel_cin,

        ]);


        // Récupérer les utilisateurs à notifier
        $utilisateurs = Utilisateur::all();


        // Définir le titre selon le type
        if ($nonConformite->type === 'HSE') {

            $titre = 'Nouvelle non-conformité HSE';

        } else {

            $titre = 'Nouvelle non-conformité Qualité';

        }


        // Envoyer la notification
        Notification::send(
            $utilisateurs,
            new ApplicationNotification(

                $titre,

                'La non-conformité ' .
                $nonConformite->code .
                ' a été enregistrée depuis un formulaire externe.',

                'non_conformite',

                route('non-conformites.index', [
                    'highlight' => $nonConformite->id
                ])

            )
        );


        return redirect()
            ->route('externe.non-conformites.create')
            ->with(
                'success',
                'La non-conformité a été enregistrée avec succès.'
            );
    }

}