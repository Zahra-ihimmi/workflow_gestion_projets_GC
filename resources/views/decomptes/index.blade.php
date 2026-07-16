@extends('layouts.app')

@section('content')

<h2>Liste des décomptes</h2>

<a href="{{ route('decomptes.create') }}">
Ajouter un décompte
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Date</th>

<th>Désignation</th>

<th>Quantité</th>

<th>N° SAP</th>

<th>N° Réception SAP</th>

<th>Statut</th>

<th>Actions</th>

</tr>

@foreach($decomptes as $decompte)

<tr>

<td>{{ $decompte->code }}</td>

<td>{{ $decompte->commande->code }}</td>

<td>{{ $decompte->date }}</td>

<td>{{ $decompte->designation }}</td>

<td>{{ $decompte->quantite_attachee }}</td>

<td>{{ $decompte->num_ses }}</td>

<td>{{ $decompte->num_rec_ses }}</td>

<td>{{ $decompte->statut_validation }}</td>

<td>

<a href="{{ route('decomptes.edit',$decompte->id) }}">
Modifier
</a>

<form action="{{ route('decomptes.destroy',$decompte->id) }}"
method="POST">

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

{{ $decomptes->links() }}

@endsection