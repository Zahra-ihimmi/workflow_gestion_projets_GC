@extends('layouts.app')

@section('title', 'Lignes Budgétaires')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Liste des Lignes Budgétaires</h2>

        <a href="{{ route('ligne-budgetaires.create') }}" class="btn btn-primary">
            Ajouter une Ligne Budgétaire
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

        <tr>

            <th>Code</th>

            <th>Intitulé</th>

            <th>Année</th>

            <th>Type</th>

            <th>Client</th>

            <th>Date Objective</th>

            <th>Montant</th>

            <th>Statut</th>

            <th>Chef de Projet</th>

            <th width="180">Actions</th>

        </tr>

        </thead>

        <tbody>

        @forelse($ligneBudgetaires as $lb)

            <tr>

                <td>{{ $lb->code }}</td>

                <td>{{ $lb->intitule }}</td>

                <td>{{ $lb->annee }}</td>

                <td>{{ $lb->type }}</td>

                <td>{{ $lb->client }}</td>

                <td>{{ \Carbon\Carbon::parse($lb->date_objective)->format('d/m/Y') }}</td>

                <td>{{ number_format($lb->montant_estimatif,2,',',' ') }}</td>

                <td>{{ $lb->statut }}</td>

                <td>

                    {{ $lb->utilisateur->nom }}
                    {{ $lb->utilisateur->prenom }}

                </td>

                <td>

                    

                    <a href="{{ route('ligne-budgetaires.edit',$lb->id) }}"
                       class="btn btn-warning btn-sm">

                        Modifier

                    </a>

                    <form action="{{ route('ligne-budgetaires.destroy',$lb->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf

                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cette ligne budgétaire ?')">

                            Supprimer

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="10" class="text-center">

                    Aucune ligne budgétaire trouvée.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    

</div>

@endsection