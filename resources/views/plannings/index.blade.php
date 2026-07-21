@extends('layouts.app')
@section('breadcrumb', 'Liste des Plannings')
@section('content')

<h2>Liste des Plannings</h2>

<a href="{{ route('plannings.create') }}">

Ajouter un Planning

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Prix</th>

<th>Désignation</th>

<th>Date début</th>

<th>Date fin prévue</th>

<th>Date début réelle</th>

<th>Actions</th>

</tr>

@foreach($plannings as $planning)

<tr>

<td>{{ $planning->code }}</td>

<td>{{ $planning->prix->code }}</td>

<td>{{ $planning->designation }}</td>

<td>{{ $planning->date_debut }}</td>

<td>{{ $planning->date_fin_prevue }}</td>

<td>{{ $planning->date_debut_reelle }}</td>

<td>

<a href="{{ route('plannings.edit',$planning->id) }}">

Modifier

</a>

<form action="{{ route('plannings.destroy',$planning->id) }}" method="POST">

@csrf
@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cette ce jalon ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $plannings->links() }}

@endsection