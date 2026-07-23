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
    /* Carte de succès */
    .success-card {
        display: flex;
        align-items: center;
        gap: 12px;
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #a3cfbb;
        border-left: 5px solid #198754;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 15px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* Icône ✓ */
    .success-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #198754;
        color: white;
        border-radius: 50%;
        font-size: 18px;
        font-weight: bold;
    }

    /* Texte */
    .success-text {
        flex: 1;
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
        <div id="success-message" class="success-card">
            <div class="success-icon">
                ✓
            </div>

            <div class="success-text">
                {{ session('success') }}
            </div>
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
                       class="btn btn-success btn-sm"
                       title="Modifier">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <form id="delete-form-{{ $lb->id }}"
                        action="{{ route('ligne-budgetaires.destroy', $lb->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $lb->id }})"
                                title="Supprimer">
                            <i class="fa-solid fa-trash"></i>
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
<div id="deleteModal" class="delete-modal">

    <div class="delete-modal-content">

        <div class="delete-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <h3>Confirmation de suppression</h3>

        <p>
            Êtes-vous sûr de vouloir supprimer cette ligne budgétaire ?
        </p>

        <span>
            Cette action est irréversible.
        </span>

        <div class="delete-actions">

            <button type="button"
                    class="btn-cancel"
                    onclick="closeDeleteModal()">
                Annuler
            </button>

            <button type="button"
                    class="btn-confirm-delete"
                    onclick="submitDelete()">
                Oui, supprimer
            </button>

        </div>

    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');

        if (successMessage) {
            setTimeout(function () {
                successMessage.style.transition = 'opacity 0.5s ease';
                successMessage.style.opacity = '0';

                setTimeout(function () {
                    successMessage.remove();
                }, 500);

            }, 3000);
        }
    });
</script>
<script>
    let deleteForm = null;

    function confirmDelete(id) {

        deleteForm = document.getElementById('delete-form-' + id);

        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {

        document.getElementById('deleteModal').style.display = 'none';

        deleteForm = null;
    }

    function submitDelete() {

        if (deleteForm) {
            deleteForm.submit();
        }
    }

    // Fermer la modal en cliquant à l'extérieur
    document.getElementById('deleteModal').addEventListener('click', function(event) {

        if (event.target === this) {
            closeDeleteModal();
        }

    });
</script>

@endsection