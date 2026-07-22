@extends('layouts.app')
@section('breadcrumb', 'liste des Habilitations')
@section('content')

<h2>Liste des Habilitations</h2>

<a href="{{ route('habilitations.create') }}">

Ajouter une Habilitation

</a>

<br><br>

<table border="1">

<tr>

<th>Personnel</th>

<th>Type</th>

<th>Date obtention</th>

<th>Durée</th>

<th>Actions</th>

</tr>

@foreach($habilitations as $habilitation)

<tr>

<td>

{{ $habilitation->personnel->nom }}

{{ $habilitation->personnel->prenom }}

</td>

<td>{{ $habilitation->type }}</td>

<td>{{ $habilitation->date_obtention }}</td>

<td>{{ $habilitation->duree_habilitation }}</td>

<td>

<a href="{{ route('habilitations.edit',$habilitation->id) }}">

Modifier

</a>

<form action="{{ route('habilitations.destroy',$habilitation->id) }}" method="POST">

@csrf

@method('DELETE')

<button>

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>



@endsection