@extends('layouts.app')
@section('breadcrumb', 'Liste des Formations')
@section('content')

<h2>Liste des Formations</h2>

<a href="{{ route('formations.create') }}">

Ajouter une Formation

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Personnel</th>

<th>Date</th>

<th>Thème</th>

<th>Animateur</th>

<th>Score</th>

<th>Actions</th>

</tr>

@foreach($formations as $formation)

<tr>

<td>{{ $formation->code }}</td>

<td>{{ $formation->personnel->nom }} {{ $formation->personnel->prenom }}</td>

<td>{{ $formation->date }}</td>

<td>{{ $formation->theme }}</td>

<td>{{ $formation->animateur }}</td>

<td>{{ $formation->score }}</td>

<td>

<a href="{{ route('formations.edit',$formation->id) }}">

Modifier

</a>

<form action="{{ route('formations.destroy',$formation->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cette formation ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $formations->links() }}

@endsection