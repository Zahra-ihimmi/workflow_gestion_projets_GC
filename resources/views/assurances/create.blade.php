@extends('layouts.app')

@section('content')

<h2>Ajouter une Assurance</h2>

<form action="{{ route('assurances.store') }}" method="POST">

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

<option>Responsabilité Civile</option>

<option>Décennale</option>

<option>Tous Risques Chantier</option>

<option>Accident de Travail</option>

<option>Transport</option>

<option>Autre</option>

</select>

<br><br>

<label>Numéro de police</label>

<input type="text" name="police">

<br><br>

<label>Date début</label>

<input type="date" name="date_debut">

<br><br>

<label>Date fin</label>

<input type="date" name="date_fin">

<br><br>

<label>Quittance</label>

<input type="text" name="quittance">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection