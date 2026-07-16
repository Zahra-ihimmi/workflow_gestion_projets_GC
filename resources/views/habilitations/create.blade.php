@extends('layouts.app')

@section('content')

<h2>Ajouter une Habilitation</h2>

<form action="{{ route('habilitations.store') }}" method="POST">

@csrf

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

<label>Type</label>

<select name="type">

<option value="">Choisir</option>

<option>Électrique</option>

<option>Travaux en hauteur</option>

<option>Conduite d'engins</option>

<option>Levage</option>

<option>Soudage</option>

<option>Autre</option>

</select>

<br><br>

<label>Date d'obtention</label>

<input type="date" name="date_obtention">

<br><br>

<label>Durée (années)</label>

<input
type="number"
step="0.5"
min="0"
name="duree_habilitation">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection