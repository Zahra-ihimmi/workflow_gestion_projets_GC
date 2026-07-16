@extends('layouts.app')

@section('content')

<h2>Modifier un Pointage</h2>

<form action="{{ route('pointages.update',$pointage->id) }}" method="POST">

@csrf

@method('PUT')

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $pointage->personnel_cin==$personnel->cin ? 'selected' : '' }}>

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $pointage->date }}">

<br><br>

<label>Nombre d'heures</label>

<input
type="number"
name="nb_heure"
step="0.25"
min="0"
max="24"
value="{{ $pointage->nb_heure }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection

