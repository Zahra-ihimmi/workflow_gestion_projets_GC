@extends('layouts.app')

@section('content')

<h2>Modifier un Planning</h2>

<form action="{{ route('plannings.update',$planning->id) }}" method="POST">

@csrf
@method('PUT')

<label>Prix</label>

<select name="prix_id">

@foreach($prix as $p)

<option
value="{{ $p->id }}"
{{ $planning->prix_id==$p->id ? 'selected' : '' }}>

{{ $p->code }}

</option>

@endforeach

</select>

<br><br>

<label>Désignation</label>

<input
type="text"
name="designation"
value="{{ $planning->designation }}">

<br><br>

<label>Date début</label>

<input
type="date"
name="date_debut"
value="{{ $planning->date_debut }}">

<br><br>

<label>Date fin prévue</label>

<input
type="date"
name="date_fin_prevue"
value="{{ $planning->date_fin_prevue }}">

<br><br>

<label>Date début réelle</label>

<input
type="date"
name="date_debut_reelle"
value="{{ $planning->date_debut_reelle }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection