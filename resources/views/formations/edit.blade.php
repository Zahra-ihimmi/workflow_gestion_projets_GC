@extends('layouts.app')

@section('content')

<h2>Modifier une Formation</h2>

<form action="{{ route('formations.update',$formation->id) }}" method="POST">

@csrf

@method('PUT')

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $formation->personnel_cin==$personnel->cin ? 'selected' : '' }}>

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $formation->date }}">

<br><br>

<label>Thème</label>

<input
type="text"
name="theme"
value="{{ $formation->theme }}">

<br><br>

<label>Animateur</label>

<input
type="text"
name="animateur"
value="{{ $formation->animateur }}">

<br><br>

<label>Score</label>

<input
type="number"
name="score"
step="0.01"
min="0"
max="100"
value="{{ $formation->score }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection