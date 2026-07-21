@extends('layouts.app')

@section('breadcrumb', 'Liste des Non-conformités')

@section('content')

<style>
    /* =========================
       Badges généraux
    ========================= */
    .nc-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
    }

    /* =========================
       Type de non-conformité
    ========================= */

    /* HSE = Rouge */
    .nc-hse {
        background-color: #f8d7da;
        color: #dc3545;
    }

    /* Qualité = Bleu */
    .nc-qualite {
        background-color: #d1ecf1;
        color: #0c5460;
    }


    /* =========================
       Classe de non-conformité
    ========================= */

    /* Critique = Rouge foncé */
    .nc-critique {
        background-color: #f8d7da;
        color: #b02a37;
    }

    /* Majeure = Orange */
    .nc-majeure {
        background-color: #ffe5d0;
        color: #fd7e14;
    }

    /* Mineure = Jaune */
    .nc-mineure {
        background-color: #fff3cd;
        color: #856404;
    }
</style>


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
        <th>Échéance</th>
        <th>Personnel</th>
        <th>Actions</th>
    </tr>


    @foreach($nonConformites as $nc)

    <tr>

        {{-- Code --}}
        <td>
            {{ $nc->code }}
        </td>


        {{-- Commande --}}
        <td>
            {{ $nc->commande->code }}
        </td>


        {{-- Date --}}
        <td>
            {{ $nc->date }}
        </td>


        {{-- Classe --}}
        <td>
            <span class="nc-badge
                @if(strtolower($nc->classe) === 'critique')
                    nc-critique
                @elseif(strtolower($nc->classe) === 'majeure')
                    nc-majeure
                @elseif(strtolower($nc->classe) === 'mineure')
                    nc-mineure
                @endif
            ">
                {{ ucfirst($nc->classe) }}
            </span>
        </td>


        {{-- Type --}}
        <td>
            <span class="nc-badge
                {{ strtolower($nc->type) === 'hse' ? 'nc-hse' : 'nc-qualite' }}">
                {{ strtoupper($nc->type) }}
            </span>
        </td>


        {{-- Échéance --}}
        <td>
            {{ $nc->echeance }}
        </td>


        {{-- Personnel --}}
        <td>
            {{ $nc->personnel->nom }}
            {{ $nc->personnel->prenom }}
        </td>


        {{-- Actions --}}
        <td>

            <a href="{{ route('non-conformites.edit', $nc->id) }}">
                Modifier
            </a>

            <form action="{{ route('non-conformites.destroy', $nc->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit">
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