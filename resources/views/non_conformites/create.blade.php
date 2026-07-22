@extends('layouts.app')

@section('content')

<h2>Ajouter une Non-conformité</h2>

<form action="{{ route('non-conformites.store') }}" method="POST">

@csrf

<label>Commande</label>

<select name="commande_id">

<option value="">Choisir</option>

@foreach($commandes as $commande)

<option value="{{ $commande->id }}">

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date">

<br><br>

<label>Classe</label>

<select name="classe">

<option value="">Choisir</option>

<option value="Mineure">Mineure</option>

<option value="Majeure">Majeure</option>

<option value="Critique">Critique</option>

</select>

<br><br>

<label>Type</label>

<select name="type" id="type" required>

<option value="">Choisir</option>

<option value="Qualité">Qualité</option>

<option value="HSE">HSE</option>

</select>

<label for="description">
        Description de la non-conformité
    </label>

    <select
        name="description"
        id="description"
        required>

        <option value="">
            Sélectionner d'abord le type de NC
        </option>

    </select>

<br><br>

<label>Echéance</label>

<input
type="date"
name="echeance">

<br><br>

<label>Personnel</label>

<select name="personnel_cin">

<option value="">Choisir</option>

@foreach($personnels as $personnel)

<option value="{{ $personnel->cin }}">

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<button>

Ajouter

</button>

</form>
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


typeSelect.addEventListener('change', function () {

    const type =
        this.value;


    // Vider la liste

    descriptionSelect.innerHTML = '';


    // Option par défaut

    const defaultOption =
        document.createElement('option');

    defaultOption.value = '';

    defaultOption.textContent =
        'Sélectionner une description';

    descriptionSelect.appendChild(
        defaultOption
    );


    // Vérifier le type

    if (descriptions[type]) {

        descriptions[type].forEach(
            function (description) {

                const option =
                    document.createElement('option');

                option.value =
                    description;

                option.textContent =
                    description;

                descriptionSelect.appendChild(
                    option
                );

            }
        );

    }

});

</script>
@endsection