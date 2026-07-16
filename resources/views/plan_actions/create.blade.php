@extends('layouts.app')

@section('content')

<h2>Ajouter un Plan d'Action</h2>

<form action="{{ route('plan-actions.store') }}" method="POST">

@csrf

<label>Commande</label>

<select name="commande_id">

<option value="">Choisir</option>

@foreach($commandes as $commande)

<option value="{{ $commande->id }}">

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Personnel</label>

<select name="personnel_cin">

<option value="">Choisir</option>

@foreach($personnels as $personnel)

<option value="{{ $personnel->cin }}">

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<label>Date SPA</label>

<input
type="date"
name="date_spa">

<br><br>

<label>Activité</label>

<input
type="text"
name="activite">

<br><br>

<label>Dangers</label>

<input
type="text"
name="dangers">

<br><br>

<label>Mesures préventives</label>

<textarea
name="mesures_preventives"
rows="4"
cols="50"></textarea>

<br><br>

<button>

Ajouter

</button>

</form>

@endsection