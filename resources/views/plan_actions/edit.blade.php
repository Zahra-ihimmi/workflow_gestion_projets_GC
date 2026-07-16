@extends('layouts.app')

@section('content')

<h2>Modifier un Plan d'Action</h2>

<form action="{{ route('plan-actions.update',$planAction->id) }}" method="POST">

@csrf

@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option
value="{{ $commande->id }}"
{{ $commande->id==$planAction->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $personnel->cin==$planAction->personnel_cin ? 'selected' : '' }}>

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<label>Date SPA</label>

<input
type="date"
name="date_spa"
value="{{ $planAction->date_spa }}">

<br><br>

<label>Activité</label>

<input
type="text"
name="activite"
value="{{ $planAction->activite }}">

<br><br>

<label>Dangers</label>

<input
type="text"
name="dangers"
value="{{ $planAction->dangers }}">

<br><br>

<label>Mesures préventives</label>

<textarea
name="mesures_preventives"
rows="4"
cols="50">{{ $planAction->mesures_preventives }}</textarea>

<br><br>

<button>

Modifier

</button>

</form>

@endsection