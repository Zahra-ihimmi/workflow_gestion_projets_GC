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

<a href="{{ route('formations.edit',$formation->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

<form id="delete-form-{{ $formation->id }}"
      action="{{ route('formations.destroy', $formation->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $formation->id }})"
            title="Supprimer">
    <i class="fa-solid fa-trash"></i>
    </button>

</form>

</td>

</tr>

@endforeach

</table>



@endsection