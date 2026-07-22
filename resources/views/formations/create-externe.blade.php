<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Déclaration d'une Formation</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6f8;
        }

        .top-bar {
            background-color: #094194;
            color: white;
            padding: 20px 0;
            margin-bottom: 35px;
        }

        .top-bar h2 {
            margin: 0;
            font-weight: 700;
        }

        .form-container {
            max-width: 800px;
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
            Déclaration d'une Formation
        </h2>

        <p class="mb-0">
            Veuillez renseigner les informations relatives
            à la formation suivie.
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
                action="{{ route('externe.formations.store') }}"
                method="POST">

                @csrf


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
                     Thème
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Thème de la formation

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        name="theme"
                        class="form-control"
                        placeholder="Ex : Sécurité au travail"
                        value="{{ old('theme') }}"
                        required>

                </div>


                {{-- =========================
                     Animateur
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Animateur

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        name="animateur"
                        class="form-control"
                        placeholder="Nom de l'animateur"
                        value="{{ old('animateur') }}"
                        required>

                </div>


                {{-- =========================
                     Score
                ========================= --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Score

                    </label>


                    <input
                        type="number"
                        name="score"
                        class="form-control"
                        step="0.01"
                        min="0"
                        max="100"
                        placeholder="Ex : 85"
                        value="{{ old('score') }}">

                    <small class="text-muted">

                        Score compris entre 0 et 100.

                    </small>

                </div>


                {{-- =========================
                     Bouton
                ========================= --}}

                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary px-5">

                        Enregistrer la formation

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


</body>

</html>