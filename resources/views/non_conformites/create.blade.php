@extends('layouts.app')

@section('content')

<h2>Ajouter une Non-conformité</h2>

<form action="{{ route('non-conformites.store') }}" method="POST">

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

<label>Date</label>

<input
type="date"
name="date">

<br><br>

<label>Classe</label>

<select name="classe">

<option value="">Choisir</option>

<option value="Mineure">Mineure</option>

<option value="Majeure">Majeure</option>

<option value="Critique">Critique</option>

</select>

<br><br>

<label>Type</label>

<select name="type">

<option value="">Choisir</option>

<option value="Qualité">Qualité</option>

<option value="HSE">HSE</option>

</select>

<br><br>

<label>Echéance</label>

<input
type="date"
name="echeance">

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

<button>

Ajouter

</button>

</form>

@endsection