@extends('layouts.app')

@section('content')

<h2>Liste des Non-conformités</h2>

<a href="{{ route('non-conformites.create') }}">

Ajouter une Non-conformité

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Date</th>

<th>Classe</th>

<th>Type</th>

<th>Echéance</th>

<th>Personnel</th>

<th>Actions</th>

</tr>

@foreach($nonConformites as $nc)

<tr>

<td>{{ $nc->code }}</td>

<td>{{ $nc->commande->code }}</td>

<td>{{ $nc->date }}</td>

<td>{{ $nc->classe }}</td>

<td>{{ $nc->type }}</td>

<td>{{ $nc->echeance }}</td>

<td>{{ $nc->personnel->nom }} {{ $nc->personnel->prenom }}</td>

<td>

<a href="{{ route('non-conformites.edit',$nc->id) }}">

Modifier

</a>

<form action="{{ route('non-conformites.destroy',$nc->id) }}" method="POST">

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

<br>

{{ $nonConformites->links() }}

@endsection