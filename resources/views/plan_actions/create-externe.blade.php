<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Saisie d'un Plan d'Action Sécurité</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6f8;
        }

        .top-bar {
            background-color: #083f92;
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
            Saisie d'un Plan d'Action Sécurité
        </h2>

        <p class="mb-0">

            Veuillez renseigner les informations
            relatives au plan d'action sécurité.

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
         Message succès
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
                action="{{ route('externe.plan-actions.store') }}"
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

                            Choisir une commande

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
                     Personnel
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Personnel

                        <span class="required">*</span>

                    </label>


                    <select
                        name="personnel_cin"
                        class="form-select"
                        required>

                        <option value="">

                            Choisir un personnel

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
                     Date SPA
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Date SPA

                        <span class="required">*</span>

                    </label>


                    <input
                        type="date"
                        name="date_spa"
                        class="form-control"
                        value="{{ old('date_spa', date('Y-m-d')) }}"
                        required>

                </div>


                {{-- =========================
                     Activité
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Activité

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        name="activite"
                        class="form-control"
                        placeholder="Décrire l'activité concernée"
                        value="{{ old('activite') }}"
                        required>

                </div>


                {{-- =========================
                     Dangers
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Dangers

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        name="dangers"
                        class="form-control"
                        placeholder="Décrire les dangers identifiés"
                        value="{{ old('dangers') }}"
                        required>

                </div>


                {{-- =========================
                     Mesures préventives
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Mesures préventives

                        <span class="required">*</span>

                    </label>


                    <textarea
                        name="mesures_preventives"
                        class="form-control"
                        rows="5"
                        placeholder="Décrire les mesures préventives à mettre en place..."
                        required>{{ old('mesures_preventives') }}</textarea>

                </div>


                {{-- =========================
                     Bouton
                ========================= --}}

                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary px-5">

                        Enregistrer le plan d'action

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


</body>

</html>