<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PointageController extends Controller
{

    public function index()
    {
        $pointages = Pointage::with('personnel')
                    ->orderBy('date','desc')
                    ->paginate(10);

        return view('pointages.index', compact('pointages'));
    }

    public function create()
    {
        $personnels = Personnel::orderBy('nom')->get();

        return view('pointages.create', compact('personnels'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'personnel_cin' => 'required',

            'date' => 'required|date',

            'nb_heure' => 'required|numeric|min:0|max:24',

        ]);

        // Génération automatique PTG-001

        $dernierNumero = Pointage::get()
            ->map(function ($item) {
                return (int) substr($item->code, -3);
            })
            ->max();

        $numero = $dernierNumero ? $dernierNumero + 1 : 1;

        $code = 'PTG-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        Pointage::create([

            'code' => $code,

            'personnel_cin' => $request->personnel_cin,

            'date' => $request->date,

            'nb_heure' => $request->nb_heure,

        ]);

        return redirect()->route('pointages.index');

    }

    public function edit($id)
    {

        $pointage = Pointage::find($id);

        $personnels = Personnel::orderBy('nom')->get();

        return view('pointages.edit', compact(
            'pointage',
            'personnels'
        ));

    }

    public function update(Request $request,$id)
    {

        $request->validate([

            'personnel_cin' => 'required',

            'date' => 'required|date',

            'nb_heure' => 'required|numeric|min:0|max:24',

        ]);

        $pointage = Pointage::find($id);

        $pointage->update([

            'personnel_cin' => $request->personnel_cin,

            'date' => $request->date,

            'nb_heure' => $request->nb_heure,

        ]);

        return redirect()->route('pointages.index');

    }

    public function destroy($id)
    {

        Pointage::find($id)->delete();

        return redirect()->route('pointages.index');

    }

}