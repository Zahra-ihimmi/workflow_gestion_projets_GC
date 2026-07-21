@extends('layouts.app')
@section('breadcrumb', "Liste des Plans d'Action")
@section('content')

<h2>Liste des Plans d'Action</h2>

<a href="{{ route('plan-actions.create') }}">

Ajouter un Plan d'Action

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Personnel</th>

<th>Date SPA</th>

<th>Activité</th>

<th>Dangers</th>

<th>Mesures préventives</th>

<th>Actions</th>

</tr>

@foreach($planActions as $plan)

<tr>

<td>{{ $plan->code }}</td>

<td>{{ $plan->commande->code }}</td>

<td>{{ $plan->personnel->nom }} {{ $plan->personnel->prenom }}</td>

<td>{{ $plan->date_spa }}</td>

<td>{{ $plan->activite }}</td>

<td>{{ $plan->dangers }}</td>

<td>{{ $plan->mesures_preventives }}</td>

<td>

<a href="{{ route('plan-actions.edit',$plan->id) }}">

Modifier

</a>

<form action="{{ route('plan-actions.destroy',$plan->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce plan d\'action ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $planActions->links() }}

@endsection