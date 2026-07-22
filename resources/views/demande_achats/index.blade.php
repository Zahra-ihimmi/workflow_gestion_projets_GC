@extends('layouts.app')

@section('breadcrumb', "Liste des demandes d'achat")

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2 class="mb-0">
            Liste des demandes d'achat
        </h2>

        <a href="{{ route('demande-achats.create') }}" class="btn btn-primary">
            Ajouter une demande d'achat
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
                <th>LB</th>
                <th>Utilisateur</th>
                <th>Estimation</th>
                <th>Date saisie</th>
                <th>Acheteur</th>
                <th>Type projet</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($demandeAchats as $da)

                <tr>

                    <td>
                        {{ $da->code }}
                    </td>

                    <td>
                        {{ $da->ligneBudgetaire->intitule ?? '-' }}
                    </td>

                    <td>
                        {{ $da->utilisateur->nom ?? '' }}
                        {{ $da->utilisateur->prenom ?? '' }}
                    </td>

                    <td>
                        {{ number_format($da->estimation, 2, ',', ' ') }}
                    </td>

                    <td>
                        {{ $da->date_saisi }}
                    </td>

                    <td>
                        {{ $da->acheteur }}
                    </td>

                    <td>
                        {{ $da->type_projet }}
                    </td>

                    <td>
                        {{ $da->categorie }}
                    </td>

                    <td>
                        {{ $da->statut }}
                    </td>

                    <td>

                        <a href="{{ route('demande-achats.edit', $da->id) }}"
                           class="btn btn-success btn-sm">
                            Modifier
                        </a>

                        <form action="{{ route('demande-achats.destroy', $da->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer cette demande d’achat ?')">
                                Supprimer
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="10" class="text-center">
                        Aucune demande d'achat trouvée.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    

</div>

@endsection