@extends('layouts.app')
@section('breadcrumb', 'Liste des Pointages')
@section('content')

<h2>Liste des Pointages</h2>

<a href="{{ route('pointages.create') }}">

Ajouter un Pointage

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Personnel</th>

<th>Date</th>

<th>Nombre d'heures</th>

<th>Actions</th>

</tr>

@foreach($pointages as $pointage)

<tr>

<td>{{ $pointage->code }}</td>

<td>{{ $pointage->personnel->nom }} {{ $pointage->personnel->prenom }}</td>

<td>{{ $pointage->date }}</td>

<td>{{ $pointage->nb_heure }}</td>

<td>

<a href="{{ route('pointages.edit',$pointage->id) }}">

Modifier

</a>

<form action="{{ route('pointages.destroy',$pointage->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce pointage ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $pointages->links() }}

@endsection