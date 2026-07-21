@extends('layouts.app')

@section('breadcrumb', 'Liste des Lignes Budgétaires')
@section('title', 'Lignes Budgétaires')

@section('content')

<style>
    /* Badge pour le type de ligne budgétaire */
    .budget-type {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
    }

    /* CAPEX = Vert */
    .type-capex {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    /* OPEX = Bleu */
    .type-opex {
        background-color: #cfe2ff;
        color: #084298;
    }

    /* PDR = Violet */
    .type-pdr {
        background-color: #e2d9f3;
        color: #59359a;
    }
</style>

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

                {{-- Code --}}
                <td>
                    {{ $lb->code }}
                </td>

                {{-- Intitulé --}}
                <td>
                    {{ $lb->intitule }}
                </td>

                {{-- Année --}}
                <td>
                    {{ $lb->annee }}
                </td>

                {{-- Type --}}
                <td>
                    <span class="budget-type
                        @if(strtolower($lb->type) === 'capex')
                            type-capex
                        @elseif(strtolower($lb->type) === 'opex')
                            type-opex
                        @elseif(strtolower($lb->type) === 'pdr')
                            type-pdr
                        @endif
                    ">
                        {{ strtoupper($lb->type) }}
                    </span>
                </td>

                {{-- Client --}}
                <td>
                    {{ $lb->client }}
                </td>

                {{-- Date Objective --}}
                <td>
                    {{ \Carbon\Carbon::parse($lb->date_objective)->format('d/m/Y') }}
                </td>

                {{-- Montant --}}
                <td>
                    {{ number_format($lb->montant_estimatif, 2, ',', ' ') }}
                </td>

                {{-- Statut --}}
                <td>
                    {{ $lb->statut }}
                </td>

                {{-- Chef de Projet --}}
                <td>
                    {{ $lb->utilisateur->nom }}
                    {{ $lb->utilisateur->prenom }}
                </td>

                {{-- Actions --}}
                <td>

                    <a href="{{ route('ligne-budgetaires.edit', $lb->id) }}"
                       class="btn btn-success btn-sm">
                        Modifier
                    </a>

                    <form action="{{ route('ligne-budgetaires.destroy', $lb->id) }}"
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