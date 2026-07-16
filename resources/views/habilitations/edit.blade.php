@extends('layouts.app')

@section('content')

<h2>Modifier une Habilitation</h2>

<form action="{{ route('habilitations.update',$habilitation->id) }}" method="POST">

@csrf

@method('PUT')

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $habilitation->personnel_cin==$personnel->cin ? 'selected' : '' }}>

{{ $personnel->nom }}

{{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<label>Type</label>

<select name="type">

<option value="Électrique" {{ $habilitation->type=="Électrique" ? 'selected':'' }}>Électrique</option>

<option value="Travaux en hauteur" {{ $habilitation->type=="Travaux en hauteur" ? 'selected':'' }}>Travaux en hauteur</option>

<option value="Conduite d'engins" {{ $habilitation->type=="Conduite d'engins" ? 'selected':'' }}>Conduite d'engins</option>

<option value="Levage" {{ $habilitation->type=="Levage" ? 'selected':'' }}>Levage</option>

<option value="Soudage" {{ $habilitation->type=="Soudage" ? 'selected':'' }}>Soudage</option>

<option value="Autre" {{ $habilitation->type=="Autre" ? 'selected':'' }}>Autre</option>

</select>

<br><br>

<label>Date d'obtention</label>

<input
type="date"
name="date_obtention"
value="{{ $habilitation->date_obtention }}">

<br><br>

<label>Durée (années)</label>

<input
type="number"
step="0.5"
min="0"
name="duree_habilitation"
value="{{ $habilitation->duree_habilitation }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection