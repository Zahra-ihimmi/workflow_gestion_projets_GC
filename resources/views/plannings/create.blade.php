@extends('layouts.app')

@section('content')

<h2>Ajouter un Planning</h2>

<form action="{{ route('plannings.store') }}" method="POST">

@csrf

<label>Prix</label>

<select name="prix_id">

<option value="">Choisir</option>

@foreach($prix as $p)

<option value="{{ $p->id }}">

{{ $p->code }}

</option>

@endforeach

</select>

<br><br>

<label>Désignation</label>

<input type="text" name="designation">

<br><br>

<label>Date début</label>

<input type="date" name="date_debut">

<br><br>

<label>Date fin prévue</label>

<input type="date" name="date_fin_prevue">

<br><br>

<label>Date début réelle</label>

<input type="date" name="date_debut_reelle">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection