@extends('layouts.app')

@section('breadcrumb', 'Liste des Rapports journaliers de Travaux')

@section('content')

<h2>Liste des Rapports de Travaux</h2>

<a href="{{ route('rapport-travaux.create') }}">
    Ajouter un rapport
</a>

<br><br>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<table border="1">

    <tr>

        <th>Code</th>

        <th>Commande</th>

        <th>Date</th>

        <th>CIN Rapporteur</th>

        <th>Météo matin</th>

        <th>Météo soir</th>

        <th>Activités réalisées</th>

        <th>Ecart HSE</th>

        <th>Ecart Qualité</th>

        <th>Actions</th>

    </tr>


    @forelse($rapports as $rapport)

        <tr>

            {{-- Code du rapport --}}
            <td>
                {{ $rapport->code }}
            </td>


            {{-- Commande --}}
            <td>
                {{ $rapport->commande->code }}
            </td>


            {{-- Date --}}
            <td>
                {{ $rapport->date }}
            </td>


            {{-- CIN du rapporteur --}}
            <td>
                {{ $rapport->cin_reporteur }}
            </td>


            {{-- Météo matin --}}
            <td>
                {{ $rapport->meteo_matin }}
            </td>


            {{-- Météo soir --}}
            <td>
                {{ $rapport->meteo_soir }}
            </td>


            {{-- Activités --}}
            <td>

                @forelse($rapport->rapportActivites as $rapportActivite)

                    <div style="margin-bottom: 8px;">

                        <strong>
                            {{ $rapportActivite->prix->code }}
                        </strong>

                        -

                        {{ $rapportActivite->activite }}

                        <span
                            style="
                                background-color: #0d6efd;
                                color: white;
                                padding: 3px 7px;
                                border-radius: 4px;
                                margin-left: 5px;
                            ">

                            {{ $rapportActivite->avancement }}%

                        </span>

                    </div>

                @empty

                    <span>
                        Aucune activité
                    </span>

                @endforelse

            </td>


            {{-- Ecart HSE --}}
            <td>
                {{ $rapport->ecart_hse }}
            </td>


            {{-- Ecart Qualité --}}
            <td>
                {{ $rapport->ecart_qualite }}
            </td>


            {{-- Actions --}}
            <td>

                <a href="{{ route('rapport-travaux.edit', $rapport->id) }}">
                    Modifier
                </a>


                <form
                    action="{{ route('rapport-travaux.destroy', $rapport->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Supprimer ce rapport de travaux ?')">

                        Supprimer

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="10" style="text-align:center;">

                Aucun rapport de travaux trouvé.

            </td>

        </tr>

    @endforelse

</table>





@endsection