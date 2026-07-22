<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Rapport journalier des travaux</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6f8;
            margin: 0;
        }

        /* Barre supérieure */

        .top-header {
            background: #033d94;
            color: white;
            padding: 22px 20px;
            text-align: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .top-header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }

        .top-header p {
            margin: 6px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }


        /* Conteneur du formulaire */

        .form-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 15px;
        }


        /* Carte */

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }


        /* Titres des sections */

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }


        /* Bouton principal */

        .btn-primary {
            padding: 10px 35px;
            font-weight: 500;
        }


        /* Responsive */

        @media (max-width: 768px) {

            .top-header h1 {
                font-size: 22px;
            }

            .form-container {
                margin-top: 25px;
            }

        }

    </style>

</head>


<body>


{{-- Barre supérieure --}}

<header class="top-header">

    <h1>
        Rapport journalier des travaux
    </h1>

    <p>
        Saisie quotidienne de l'avancement et des activités réalisées
    </p>

</header>



<div class="container form-container">


    {{-- Erreurs --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Veuillez corriger les erreurs suivantes :
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- Message de succès --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    {{-- Carte du formulaire --}}

    <div class="card shadow-sm">

        <div class="card-body p-4">


            <form
                action="{{ route('externe.rapport-journalier.store') }}"
                method="POST">

                @csrf


                {{-- Commande --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Commande
                        <span class="text-danger">*</span>

                    </label>


                    <select
                        name="commande_id"
                        id="commande_id"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner une commande

                        </option>


                        @foreach($commandes as $commande)

                            <option
                                value="{{ $commande->id }}">

                                {{ $commande->code }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Date --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Date
                        <span class="text-danger">*</span>

                    </label>


                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required>

                </div>

                {{-- CIN du rapporteur --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        CIN du rapporteur
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="cin_reporteur"
                        class="form-control"
                        placeholder="Ex : AB123456"
                        value="{{ old('cin_reporteur') }}"
                        required>

                </div>


                {{-- Météo du matin --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Météo du matin

                    </label>

                    <input
                        type="text"
                        name="meteo_matin"
                        class="form-control"
                        placeholder="Ex : Ensoleillé, Nuageux, Pluvieux..."
                        value="{{ old('meteo_matin') }}">

                </div>


                {{-- Météo du soir --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Météo du soir

                    </label>

                    <input
                        type="text"
                        name="meteo_soir"
                        class="form-control"
                        placeholder="Ex : Ensoleillé, Nuageux, Pluvieux..."
                        value="{{ old('meteo_soir') }}">

                </div>
                {{-- Écart HSE --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Écart HSE

                    </label>


                    <textarea
                        name="ecart_hse"
                        class="form-control"
                        rows="3"
                        placeholder="Décrire les éventuels écarts HSE constatés..."></textarea>

                </div>


                {{-- Écart Qualité --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Écart Qualité

                    </label>


                    <textarea
                        name="ecart_qualite"
                        class="form-control"
                        rows="3"
                        placeholder="Décrire les éventuels écarts qualité constatés..."></textarea>

                </div>


                <hr class="my-4">


                {{-- Activités réalisées --}}

                <h4 class="section-title">

                    Activités réalisées

                </h4>


                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Prix
                                </th>

                                <th>
                                    Activité
                                </th>

                                <th>
                                    Avancement (%)
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="activites-container">

                        </tbody>

                    </table>

                </div>


                {{-- Ajouter activité --}}

                <button
                    type="button"
                    id="addActivite"
                    class="btn btn-secondary">

                    + Ajouter une activité

                </button>


                {{-- Enregistrer --}}

                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary px-5">

                        Enregistrer le rapport

                    </button>

                </div>


            </form>

        </div>

    </div>

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

        alert(
            'Veuillez sélectionner une commande.'
        );

        return;

    }


    const commande =
        commandes.find(
            c => c.id == commandeId
        );


    if (
        !commande ||
        !commande.prix ||
        !commande.prix.length
    ) {

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
                class="form-select"
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
        .addEventListener(
            'click',
            function () {

                row.remove();

            }
        );


    index++;

});

</script>


</body>

</html>