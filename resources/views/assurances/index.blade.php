@extends('layouts.app')
@section('breadcrumb', 'Liste des Assurances')
@section('content')

<h2>Liste des Assurances</h2>

<a href="{{ route('assurances.create') }}">

Ajouter une Assurance

</a>

<br><br>

<table border="1">

<tr>

<th>Fournisseur</th>

<th>Type</th>

<th>Police</th>

<th>Date début</th>

<th>Date fin</th>

<th>Quittance</th>

<th>Actions</th>

</tr>

@foreach($assurances as $assurance)

<tr>

<td>{{ $assurance->fournisseur->nom }}</td>

<td>{{ $assurance->type }}</td>

<td>{{ $assurance->police }}</td>

<td>{{ $assurance->date_debut }}</td>

<td>{{ $assurance->date_fin }}</td>

<td>{{ $assurance->quittance }}</td>

<td>

<a href="{{ route('assurances.edit',$assurance->id) }}">

Modifier

</a>

<form action="{{ route('assurances.destroy',$assurance->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cette assurance ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>



@endsection