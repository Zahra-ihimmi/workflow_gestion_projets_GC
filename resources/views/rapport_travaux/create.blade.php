@extends('layouts.app')

@section('breadcrumb', 'Ajouter un Rapport de Travaux')

@section('content')

<div class="container mt-4">

    <h2>Ajouter un Rapport de Travaux</h2>

    <form action="{{ route('rapport-travaux.store') }}" method="POST">

        @csrf

        {{-- Commande --}}
        <div class="mb-3">

            <label class="form-label">
                Commande
            </label>

            <select
                name="commande_id"
                id="commande_id"
                class="form-control"
                required>

                <option value="">
                    Sélectionner une commande
                </option>

                @foreach($commandes as $commande)

                    <option value="{{ $commande->id }}">

                        {{ $commande->code }}

                    </option>

                @endforeach

            </select>

        </div>


        {{-- Date --}}
        <div class="mb-3">

            <label class="form-label">
                Date
            </label>

            <input
                type="date"
                name="date"
                class="form-control"
                required>

        </div>


        {{-- Écart HSE --}}
        <div class="mb-3">

            <label class="form-label">
                Écart HSE
            </label>

            <textarea
                name="ecart_hse"
                class="form-control"></textarea>

        </div>


        {{-- Écart Qualité --}}
        <div class="mb-3">

            <label class="form-label">
                Écart Qualité
            </label>

            <textarea
                name="ecart_qualite"
                class="form-control"></textarea>

        </div>


        <hr>

        <h4>Activités réalisées</h4>


        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Prix</th>

                    <th>Activité</th>

                    <th>Avancement (%)</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody id="activites-container">

            </tbody>

        </table>


        <button
            type="button"
            id="addActivite"
            class="btn btn-secondary">

            + Ajouter une activité

        </button>


        <br><br>


        <button
            type="submit"
            class="btn btn-primary">

            Enregistrer

        </button>

    </form>

</div>
<script>

const commandes = @json($commandes);

let index = 0;

const commandeSelect =
    document.getElementById('commande_id');

const container =
    document.getElementById('activites-container');

const addButton =
    document.getElementById('addActivite');


addButton.addEventListener('click', function () {

    const commandeId =
        commandeSelect.value;


    if (!commandeId) {

        alert('Veuillez sélectionner une commande.');

        return;

    }


    const commande =
        commandes.find(
            c => c.id == commandeId
        );


    if (!commande || !commande.prix.length) {

        alert(
            'Cette commande ne contient aucun prix.'
        );

        return;

    }


    const row =
        document.createElement('tr');


    row.innerHTML = `

        <td>

            <select
                name="activites[${index}][prix_id]"
                class="form-control"
                required>

                <option value="">
                    Sélectionner un prix
                </option>

                ${commande.prix.map(prix => `

                    <option value="${prix.id}">

                        ${prix.code}

                    </option>

                `).join('')}

            </select>

        </td>


        <td>

            <input
                type="text"
                name="activites[${index}][activite]"
                class="form-control"
                placeholder="Ex : Décapage du terrain"
                required>

        </td>


        <td>

            <input
                type="number"
                name="activites[${index}][avancement]"
                class="form-control"
                min="0"
                max="100"
                step="0.01"
                placeholder="0"
                required>

        </td>


        <td>

            <button
                type="button"
                class="btn btn-danger btn-sm remove-row">

                Supprimer

            </button>

        </td>

    `;


    container.appendChild(row);


    row.querySelector('.remove-row')
        .addEventListener('click', function () {

            row.remove();

        });


    index++;

});

</script>

@endsection