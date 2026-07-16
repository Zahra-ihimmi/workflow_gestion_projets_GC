@extends('layouts.app')

@section('content')

<h2>Ajouter un Pointage</h2>

<form action="{{ route('pointages.store') }}" method="POST">

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

<label>Date</label>

<input type="date" name="date">

<br><br>

<label>Nombre d'heures</label>

<input
type="number"
name="nb_heure"
step="0.25"
min="0"
max="24">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection