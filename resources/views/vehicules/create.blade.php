@extends('layouts.app')

@section('content')

<h2>Ajouter un Véhicule</h2>

<form action="{{ route('vehicules.store') }}" method="POST">

@csrf

<label>Fournisseur</label>

<select name="fournisseur_id">

<option value="">Choisir</option>

@foreach($fournisseurs as $fournisseur)

<option value="{{ $fournisseur->id }}">

{{ $fournisseur->nom }}

</option>

@endforeach

</select>

<br><br>

<label>Type</label>

<select name="type">

<option value="">Choisir</option>

<option>Voiture</option>

<option>Camionnette</option>

<option>Camion</option>

<option>Grue</option>

<option>Chargeuse</option>

<option>Pelle mécanique</option>

<option>Niveleuse</option>

<option>Compacteur</option>

<option>Autre</option>

</select>

<br><br>

<label>Type d'habilitation</label>

<input type="text" name="type_habilitation">

<br><br>

<label>Date début</label>

<input type="date" name="date_debut">

<br><br>

<label>Date fin</label>

<input type="date" name="date_fin">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection