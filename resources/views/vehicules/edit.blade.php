@extends('layouts.app')

@section('content')

<h2>Modifier un Véhicule</h2>

<form action="{{ route('vehicules.update',$vehicule->id) }}" method="POST">

@csrf

@method('PUT')

<label>Fournisseur</label>

<select name="fournisseur_id">

@foreach($fournisseurs as $fournisseur)

<option
value="{{ $fournisseur->id }}"
{{ $vehicule->fournisseur_id==$fournisseur->id ? 'selected' : '' }}>

{{ $fournisseur->nom }}

</option>

@endforeach

</select>

<br><br>

<label>Type</label>

<select name="type">

<option value="Voiture" {{ $vehicule->type=="Voiture" ? 'selected':'' }}>Voiture</option>

<option value="Camionnette" {{ $vehicule->type=="Camionnette" ? 'selected':'' }}>Camionnette</option>

<option value="Camion" {{ $vehicule->type=="Camion" ? 'selected':'' }}>Camion</option>

<option value="Grue" {{ $vehicule->type=="Grue" ? 'selected':'' }}>Grue</option>

<option value="Chargeuse" {{ $vehicule->type=="Chargeuse" ? 'selected':'' }}>Chargeuse</option>

<option value="Pelle mécanique" {{ $vehicule->type=="Pelle mécanique" ? 'selected':'' }}>Pelle mécanique</option>

<option value="Niveleuse" {{ $vehicule->type=="Niveleuse" ? 'selected':'' }}>Niveleuse</option>

<option value="Compacteur" {{ $vehicule->type=="Compacteur" ? 'selected':'' }}>Compacteur</option>

<option value="Autre" {{ $vehicule->type=="Autre" ? 'selected':'' }}>Autre</option>

</select>

<br><br>

<label>Type d'habilitation</label>

<input
type="text"
name="type_habilitation"
value="{{ $vehicule->type_habilitation }}">

<br><br>

<label>Date début</label>

<input
type="date"
name="date_debut"
value="{{ $vehicule->date_debut }}">

<br><br>

<label>Date fin</label>

<input
type="date"
name="date_fin"
value="{{ $vehicule->date_fin }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection