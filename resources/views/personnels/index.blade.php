@extends('layouts.app')
@section('breadcrumb', 'Liste du Personnel')
@section('content')

<h2>Liste du Personnel</h2>

<a href="{{ route('personnels.create') }}">

Ajouter un Personnel

</a>

<br><br>

<table border="1">

<tr>

<th>CIN</th>

<th>Fournisseur</th>

<th>Nom</th>

<th>Prénom</th>

<th>Fonction</th>

<th>Type Contrat</th>

<th>PNE</th>

<th>Niveau</th>

<th>Date Début</th>

<th>Date Fin</th>

<th>Actions</th>

</tr>

@foreach($personnels as $personnel)

<tr>

<td>{{ $personnel->cin }}</td>

<td>{{ $personnel->fournisseur->nom }}</td>

<td>{{ $personnel->nom }}</td>

<td>{{ $personnel->prenom }}</td>

<td>{{ $personnel->fonction }}</td>

<td>{{ $personnel->type_contrat }}</td>

<td>{{ $personnel->pne }}</td>

<td>{{ $personnel->niveau }}</td>

<td>{{ $personnel->date_debut }}</td>

<td>{{ $personnel->date_fin }}</td>

<td>

<a href="{{ route('personnels.edit',$personnel->id) }}">

Modifier

</a>

<form action="{{ route('personnels.destroy',$personnel->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce personnel ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $personnels->links() }}

@endsection