@extends('layouts.app')

@section('content')

<h2>Ajouter une Formation</h2>

<form action="{{ route('formations.store') }}" method="POST">

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

<label>Thème</label>

<input type="text" name="theme">

<br><br>

<label>Animateur</label>

<input type="text" name="animateur">

<br><br>

<label>Score</label>

<input
type="number"
name="score"
step="0.01"
min="0"
max="100">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection