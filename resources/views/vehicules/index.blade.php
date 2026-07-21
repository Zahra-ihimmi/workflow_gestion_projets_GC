@extends('layouts.app')
@section('breadcrumb', 'Liste des Véhicules')
@section('content')

<h2>Liste des Véhicules</h2>

<a href="{{ route('vehicules.create') }}">

Ajouter un Véhicule

</a>

<br><br>

<table border="1">

<tr>

<th>Fournisseur</th>

<th>Type</th>

<th>Type habilitation</th>

<th>Date début</th>

<th>Date fin</th>

<th>Actions</th>

</tr>

@foreach($vehicules as $vehicule)

<tr>

<td>{{ $vehicule->fournisseur->nom }}</td>

<td>{{ $vehicule->type }}</td>

<td>{{ $vehicule->type_habilitation }}</td>

<td>{{ $vehicule->date_debut }}</td>

<td>{{ $vehicule->date_fin }}</td>

<td>

<a href="{{ route('vehicules.edit',$vehicule->id) }}">

Modifier

</a>

<form action="{{ route('vehicules.destroy',$vehicule->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce véhicule ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $vehicules->links() }}

@endsection