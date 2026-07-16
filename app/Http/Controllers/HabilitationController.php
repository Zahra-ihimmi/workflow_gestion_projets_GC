<?php

namespace App\Http\Controllers;

use App\Models\Habilitation;
use App\Models\Personnel;
use Illuminate\Http\Request;

class HabilitationController extends Controller
{

    public function index()
    {
        $habilitations = Habilitation::with('personnel')
                        ->orderBy('date_obtention','desc')
                        ->paginate(10);

        return view('habilitations.index',compact('habilitations'));
    }

    public function create()
    {
        $personnels = Personnel::orderBy('nom')->get();

        return view('habilitations.create',compact('personnels'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'personnel_cin'=>'required',

            'type'=>'required',

            'date_obtention'=>'required|date',

            'duree_habilitation'=>'required|numeric|min:0',

        ]);

        Habilitation::create([

            'personnel_cin'=>$request->personnel_cin,

            'type'=>$request->type,

            'date_obtention'=>$request->date_obtention,

            'duree_habilitation'=>$request->duree_habilitation,

        ]);

        return redirect()->route('habilitations.index');

    }

    public function edit($id)
    {

        $habilitation = Habilitation::find($id);

        $personnels = Personnel::orderBy('nom')->get();

        return view('habilitations.edit',compact(
            'habilitation',
            'personnels'
        ));

    }

    public function update(Request $request,$id)
    {

        $request->validate([

            'personnel_cin'=>'required',

            'type'=>'required',

            'date_obtention'=>'required|date',

            'duree_habilitation'=>'required|numeric|min:0',

        ]);

        $habilitation = Habilitation::find($id);

        $habilitation->update([

            'personnel_cin'=>$request->personnel_cin,

            'type'=>$request->type,

            'date_obtention'=>$request->date_obtention,

            'duree_habilitation'=>$request->duree_habilitation,

        ]);

        return redirect()->route('habilitations.index');

    }

    public function destroy($id)
    {

        Habilitation::find($id)->delete();

        return redirect()->route('habilitations.index');

    }

}