@extends('layouts.app')

@section('content')

<h2>Modifier une Non-conformité</h2>

<form action="{{ route('non-conformites.update',$nonConformite->id) }}" method="POST">

@csrf

@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option
value="{{ $commande->id }}"
{{ $commande->id==$nonConformite->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $nonConformite->date }}">

<br><br>

<label>Classe</label>

<select name="classe">

<option
value="Mineure"
{{ $nonConformite->classe=="Mineure" ? 'selected' : '' }}>

Mineure

</option>

<option
value="Majeure"
{{ $nonConformite->classe=="Majeure" ? 'selected' : '' }}>

Majeure

</option>

<option
value="Critique"
{{ $nonConformite->classe=="Critique" ? 'selected' : '' }}>

Critique

</option>

</select>

<br><br>

<label>Type</label>

<select name="type" id="type" required>

<option
value="Qualité"
{{ $nonConformite->type=="Qualité" ? 'selected' : '' }}>

Qualité

</option>

<option
value="HSE"
{{ $nonConformite->type=="HSE" ? 'selected' : '' }}>

HSE

</option>

</select>
<br><br>
<label for="description">
        Description de la non-conformité
    </label>

    <select
        name="description"
        id="description"
        class="form-control"
        required>

    </select>
<br><br>

<label>Echéance</label>

<input
type="date"
name="echeance"
value="{{ $nonConformite->echeance }}">

<br><br>

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $personnel->cin==$nonConformite->personnel_cin ? 'selected' : '' }}>

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<button>

Modifier

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


function chargerDescriptions(
    type,
    descriptionSelectionnee = null
) {

    descriptionSelect.innerHTML = '';


    const defaultOption =
        document.createElement('option');

    defaultOption.value = '';

    defaultOption.textContent =
        'Sélectionner une description';

    descriptionSelect.appendChild(
        defaultOption
    );


    if (descriptions[type]) {

        descriptions[type].forEach(
            function (description) {

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


// Charger la description existante

chargerDescriptions(
    typeSelect.value,
    @json($nonConformite->description)
);


// Changer les options lorsque le type change

typeSelect.addEventListener(
    'change',
    function () {

        chargerDescriptions(
            this.value
        );

    }
);

</script>
@endsection