<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Déclaration d'une Non-conformité</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6f8;
        }

        .top-bar {
            background-color: #073c8d;
            color: white;
            padding: 20px 0;
            margin-bottom: 35px;
        }

        .top-bar h2 {
            margin: 0;
            font-weight: 700;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto 50px auto;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .required {
            color: red;
        }

    </style>

</head>


<body>


{{-- =========================
     Barre supérieure
========================= --}}

<div class="top-bar">

    <div class="container">

        <h2>
            Déclaration d'une Non-conformité
        </h2>

        <p class="mb-0">
            Veuillez renseigner les informations relatives
            à la non-conformité constatée.
        </p>

    </div>

</div>


<div class="container form-container">


    {{-- =========================
         Erreurs
    ========================= --}}

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


    {{-- =========================
         Succès
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="card shadow-sm">

        <div class="card-body p-4">


            <form
                action="{{ route('externe.non-conformites.store') }}"
                method="POST">

                @csrf


                {{-- =========================
                     Commande
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Commande

                        <span class="required">*</span>

                    </label>


                    <select
                        name="commande_id"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner une commande

                        </option>


                        @foreach($commandes as $commande)

                            <option
                                value="{{ $commande->id }}"
                                {{ old('commande_id') == $commande->id ? 'selected' : '' }}>

                                {{ $commande->code }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =========================
                     Date
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Date

                        <span class="required">*</span>

                    </label>


                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ old('date', date('Y-m-d')) }}"
                        required>

                </div>


                {{-- =========================
                     Classe
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Classe de la non-conformité

                        <span class="required">*</span>

                    </label>


                    <select
                        name="classe"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner une classe

                        </option>

                        <option
                            value="critique"
                            {{ old('classe') == 'critique' ? 'selected' : '' }}>

                            Critique

                        </option>

                        <option
                            value="majeure"
                            {{ old('classe') == 'majeure' ? 'selected' : '' }}>

                            Majeure

                        </option>

                        <option
                            value="mineure"
                            {{ old('classe') == 'mineure' ? 'selected' : '' }}>

                            Mineure

                        </option>

                    </select>

                </div>


                {{-- =========================
                     Type
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Type de non-conformité

                        <span class="required">*</span>

                    </label>


                    <select
                        name="type"
                        id="type"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner un type

                        </option>

                        <option
                            value="HSE"
                            {{ old('type') == 'HSE' ? 'selected' : '' }}>

                            HSE

                        </option>

                        <option
                            value="Qualité"
                            {{ old('type') == 'Qualité' ? 'selected' : '' }}>

                            Qualité

                        </option>

                    </select>

                </div>


                {{-- =========================
                     Description
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Description

                        <span class="required">*</span>

                    </label>


                    <select
                        name="description"
                        id="description"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner d'abord le type

                        </option>

                    </select>

                </div>


                {{-- =========================
                     Échéance
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Échéance

                        <span class="required">*</span>

                    </label>


                    <input
                        type="date"
                        name="echeance"
                        class="form-control"
                        value="{{ old('echeance') }}"
                        required>

                </div>


                {{-- =========================
                     Personnel
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Personnel concerné

                        <span class="required">*</span>

                    </label>


                    <select
                        name="personnel_cin"
                        class="form-select"
                        required>

                        <option value="">

                            Sélectionner un personnel

                        </option>


                        @foreach($personnels as $personnel)

                            <option
                                value="{{ $personnel->cin }}"
                                {{ old('personnel_cin') == $personnel->cin ? 'selected' : '' }}>

                                {{ $personnel->nom }}
                                {{ $personnel->prenom }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =========================
                     Bouton
                ========================= --}}

                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary px-5">

                        Enregistrer la non-conformité

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


{{-- =========================
     JavaScript
========================= --}}

<script>

const descriptions = {

    HSE: [

        "Défaillance Technique",

        "Défaillance Organisationnelle",

        "Erreur Humaine",

        "Non-conformité Environnementale",

        "Situation Dangereuse",

        "Violation de règle",

        "Défaillance EPI",

        "Manque de Signalisation",

        "Manque de Formation",

        "Défaillance Systémique"

    ],

    Qualité: [

        "NC liée à l'environnement d'exécution",

        "Conception ou plan erroné",

        "Défaut de contrôle ou d'essai",

        "Non-respect d'une procédure ou méthode",

        "Documentation ou traçabilité manquante",

        "Produits ou équipements NC",

        "Anomalie de finition ou esthétique",

        "Vice de mise en œuvre ou d'exécution",

        "Défaut de matériau",

        "Excès dimensionnel ou géométrique"

    ]

};


const typeSelect =
    document.getElementById('type');

const descriptionSelect =
    document.getElementById('description');


function chargerDescriptions(
    type,
    descriptionSelectionnee = null
) {

    descriptionSelect.innerHTML =
        '<option value="">Sélectionner une description</option>';


    if (descriptions[type]) {

        descriptions[type].forEach(
            function(description) {

                const option =
                    document.createElement('option');

                option.value =
                    description;

                option.textContent =
                    description;


                if (
                    description ===
                    descriptionSelectionnee
                ) {

                    option.selected = true;

                }


                descriptionSelect.appendChild(
                    option
                );

            }
        );

    }

}


typeSelect.addEventListener(
    'change',
    function() {

        chargerDescriptions(
            this.value
        );

    }
);


// Restaurer les valeurs après erreur de validation

@if(old('type'))

    chargerDescriptions(
        @json(old('type')),
        @json(old('description'))
    );

@endif

</script>


</body>

</html>