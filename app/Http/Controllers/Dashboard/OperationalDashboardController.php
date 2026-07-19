<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\LigneBudgetaire;
use App\Models\NonConformite;
use App\Models\Personnel;
use App\Models\Pointage;
use App\Models\Utilisateur;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperationalDashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. FILTRES
        |--------------------------------------------------------------------------
        */

        $chefProjetId = $request->input('chef_projet_id');
        $commandeId = $request->input('commande_id');
        $fournisseurId = $request->input('fournisseur_id');

        $periode = $request->input(
            'periode',
            'annee_courante'
        );

        /*
        |--------------------------------------------------------------------------
        | 2. PÉRIODE
        |--------------------------------------------------------------------------
        */

        $aujourdHui = Carbon::today();

        switch ($periode) {

            case 'mois':
                $dateDebut = $aujourdHui->copy()->startOfMonth();
                $dateFin = $aujourdHui->copy()->endOfMonth();
                break;

            case 'trimestre':
                $dateDebut = $aujourdHui->copy()->startOfQuarter();
                $dateFin = $aujourdHui->copy()->endOfQuarter();
                break;

            case 'annee_passee':
                $dateDebut = $aujourdHui->copy()
                    ->subYear()
                    ->startOfYear();

                $dateFin = $aujourdHui->copy()
                    ->subYear()
                    ->endOfYear();
                break;

            case 'annee_prochaine':
                $dateDebut = $aujourdHui->copy()
                    ->addYear()
                    ->startOfYear();

                $dateFin = $aujourdHui->copy()
                    ->addYear()
                    ->endOfYear();
                break;

            case 'annee_courante':
            default:

                $periode = 'annee_courante';

                $dateDebut = $aujourdHui->copy()
                    ->startOfYear();

                $dateFin = $aujourdHui->copy()
                    ->endOfYear();

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. DONNÉES DES FILTRES
        |--------------------------------------------------------------------------
        */

        $chefsProjet = Utilisateur::query()
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        $fournisseurs = Fournisseur::query()
            ->orderBy('nom')
            ->get();

        $commandesListe = Commande::query()
            ->orderBy('code')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 4. REQUÊTE PRINCIPALE COMMANDES
        |--------------------------------------------------------------------------
        */

        $commandesQuery = Commande::with([
            'fournisseur',
            'demandeAchat.ligneBudgetaire.utilisateur',
            'prix.planning',
            'rapportTravaux.rapportActivites.prix',
            'nonConformites',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTRE CHEF DE PROJET
        |--------------------------------------------------------------------------
        */

        if ($chefProjetId) {

            $commandesQuery->whereHas(
                'demandeAchat.ligneBudgetaire',
                function ($query) use ($chefProjetId) {

                    $query->where(
                        'utilisateur_id',
                        $chefProjetId
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTRE COMMANDE
        |--------------------------------------------------------------------------
        */

        if ($commandeId) {

            $commandesQuery->where(
                'id',
                $commandeId
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTRE FOURNISSEUR
        |--------------------------------------------------------------------------
        */

        if ($fournisseurId) {

            $commandesQuery->where(
                'fournisseur_id',
                $fournisseurId
            );
        }

        $commandes = $commandesQuery->get();

        /*
        |--------------------------------------------------------------------------
        | 5. STATUTS DES COMMANDES
        |--------------------------------------------------------------------------
        */

        $totalProjetsActifs = $commandes
            ->filter(function ($commande) {

                return strtolower(
                    trim($commande->statut ?? '')
                ) === 'exécution';

            })
            ->count();

        $totalProjetsSuspendus = $commandes
            ->filter(function ($commande) {

                return strtolower(
                    trim($commande->statut ?? '')
                ) === 'hold';

            })
            ->count();

        $totalProjetsClotures = $commandes
            ->filter(function ($commande) {

                return strtolower(
                    trim($commande->statut ?? '')
                ) === 'clôture';

            })
            ->count();

        $totalProjetsReceptionDefinitive = $commandes
            ->filter(function ($commande) {

                return strtolower(
                    trim($commande->statut ?? '')
                ) === 'réception définitive';

            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | 6. COMPLEXITÉ DU PORTEFEUILLE
        |--------------------------------------------------------------------------
        */

        $complexiteMoyenne = $commandes
            ->filter(function ($commande) {

                return is_numeric(
                    $commande->complexite
                );

            })
            ->avg('complexite');

        $complexiteMoyenne = round(
            $complexiteMoyenne ?? 0,
            2
        );

        /*
        |--------------------------------------------------------------------------
        | 7. PROJETS EN RETARD
        |--------------------------------------------------------------------------
        */

        $projetsEnRetard = $commandes
            ->filter(function ($commande) use ($aujourdHui) {

                if (
                    !$commande->date_os ||
                    !is_numeric($commande->duree_travaux)
                ) {
                    return false;
                }

                $dateFinPrevue = Carbon::parse(
                    $commande->date_os
                )->addDays(
                    (int) $commande->duree_travaux
                );

                return
                    $dateFinPrevue->lt(
                        $aujourdHui
                    )
                    &&
                    strtolower(
                        trim($commande->statut ?? '')
                    ) === 'exécution';

            })
            ->values();

        $totalProjetsEnRetard =
            $projetsEnRetard->count();

        /*
        |--------------------------------------------------------------------------
        | 8. JOURS RESTANTS
        |--------------------------------------------------------------------------
        */

        $joursRestants = $commandes
            ->map(function ($commande) use ($aujourdHui) {

                if (
                    !$commande->date_os ||
                    !is_numeric($commande->duree_travaux)
                ) {
                    return null;
                }

                $dateFinPrevue = Carbon::parse(
                    $commande->date_os
                )->addDays(
                    (int) $commande->duree_travaux
                );

                return $aujourdHui->diffInDays(
                    $dateFinPrevue,
                    false
                );
            })
            ->filter(function ($jours) {

                return $jours !== null
                    && $jours >= 0;

            });

        $joursRestantsMoyens = round(
            $joursRestants->avg() ?? 0,
            1
        );

        /*
        |--------------------------------------------------------------------------
        | 9. AVANCEMENT PHYSIQUE
        |--------------------------------------------------------------------------
        */

        $rapportActivites = $commandes
            ->flatMap(function ($commande) {

                return $commande
                    ->rapportTravaux
                    ->flatMap(function ($rapport) {

                        return $rapport
                            ->rapportActivites;

                    });

            });

        $avancementGlobal = $rapportActivites
            ->filter(function ($activite) {

                return is_numeric(
                    $activite->avancement
                );

            })
            ->avg('avancement');

        $avancementGlobal = round(
            $avancementGlobal ?? 0,
            1
        );

        /*
        |--------------------------------------------------------------------------
        | 10. AVANCEMENT PAR PROJET
        |--------------------------------------------------------------------------
        */

        $avancementParProjet = $commandes
            ->map(function ($commande) {

                $activites = $commande
                    ->rapportTravaux
                    ->flatMap(function ($rapport) {

                        return $rapport
                            ->rapportActivites;

                    });

                $avancement = $activites
                    ->filter(function ($activite) {

                        return is_numeric(
                            $activite->avancement
                        );

                    })
                    ->avg('avancement');

                return [
                    'code' =>
                        $commande->code,

                    'avancement' =>
                        round(
                            $avancement ?? 0,
                            1
                        ),
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | 11. CONSOMMATION DES PRIX
        |--------------------------------------------------------------------------
        */

        $prix = $commandes
            ->flatMap(function ($commande) {

                return $commande->prix;

            });

        $montantTotalBordereau = $prix
            ->sum(function ($prix) {

                return
                    (float) $prix->quantite
                    *
                    (float) $prix->prix_unitaire;

            });

        $montantConsomme = $rapportActivites
            ->sum(function ($activite) {

                if (!$activite->prix) {
                    return 0;
                }

                return
                    (float) $activite->prix->quantite
                    *
                    (float) $activite->prix->prix_unitaire
                    *
                    (
                        (float) $activite->avancement
                        / 100
                    );
            });

        $resteAConsommer =
            max(
                0,
                $montantTotalBordereau
                -
                $montantConsomme
            );

        $tauxConsommation =
            $montantTotalBordereau > 0
                ? (
                    $montantConsomme
                    /
                    $montantTotalBordereau
                ) * 100
                : 0;

        $tauxConsommation =
            round(
                $tauxConsommation,
                1
            );

        /*
        |--------------------------------------------------------------------------
        | 12. PERSONNEL
        |--------------------------------------------------------------------------
        */

        $personnelsQuery = Personnel::with(
            'pointages'
        );

        if ($fournisseurId) {

            $personnelsQuery->where(
                'fournisseur_id',
                $fournisseurId
            );
        }

        $personnels = $personnelsQuery->get();

        $totalPersonnel =
            $personnels->count();

        $personnelCins =
            $personnels
                ->pluck('cin');

        $pointages = Pointage::query()
            ->whereBetween(
                'date',
                [
                    $dateDebut->toDateString(),
                    $dateFin->toDateString(),
                ]
            )
            ->when(
                $personnelCins->isNotEmpty(),
                function ($query) use ($personnelCins) {

                    $query->whereIn(
                        'personnel_cin',
                        $personnelCins
                    );

                }
            )
            ->get();

        $personnelActif =
            $pointages
                ->pluck('personnel_cin')
                ->unique()
                ->count();

        $totalHeures =
            $pointages->sum('nb_heure');

        $moyenneHeuresPersonne =
            $personnelActif > 0
                ? $totalHeures
                    / $personnelActif
                : 0;

        $moyenneHeuresPersonne =
            round(
                $moyenneHeuresPersonne,
                2
            );

        /*
        |--------------------------------------------------------------------------
        | 13. ENGINES
        |--------------------------------------------------------------------------
        */

        $vehiculesQuery = Vehicule::with(
            'fournisseur'
        );

        if ($fournisseurId) {

            $vehiculesQuery->where(
                'fournisseur_id',
                $fournisseurId
            );
        }

        $vehicules =
            $vehiculesQuery->get();

        $totalEngins =
            $vehicules->count();

        $enginsActifs =
            $vehicules
                ->filter(function ($vehicule) use (
                    $aujourdHui
                ) {

                    $dateDebutVehicule =
                        $vehicule->date_debut
                            ? Carbon::parse(
                                $vehicule->date_debut
                            )
                            : null;

                    $dateFinVehicule =
                        $vehicule->date_fin
                            ? Carbon::parse(
                                $vehicule->date_fin
                            )
                            : null;

                    return
                        (
                            !$dateDebutVehicule
                            ||
                            $dateDebutVehicule
                                ->lte($aujourdHui)
                        )
                        &&
                        (
                            !$dateFinVehicule
                            ||
                            $dateFinVehicule
                                ->gte($aujourdHui)
                        );
                })
                ->count();

        /*
        |--------------------------------------------------------------------------
        | 14. NON-CONFORMITÉS
        |--------------------------------------------------------------------------
        */

        $commandeIds =
            $commandes->pluck('id');

        $nonConformites =
            NonConformite::with([
                'commande',
                'personnel',
            ])
            ->whereIn(
                'commande_id',
                $commandeIds
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | QUALITÉ
        |--------------------------------------------------------------------------
        */

        $ncQualite =
            $nonConformites
                ->filter(function ($nc) {

                    return strtolower(
                        trim($nc->type ?? '')
                    ) === 'qualité';

                });

        /*
        |--------------------------------------------------------------------------
        | HSE
        |--------------------------------------------------------------------------
        */

        $ncHse =
            $nonConformites
                ->filter(function ($nc) {

                    return strtolower(
                        trim($nc->type ?? '')
                    ) === 'hse';

                });

        /*
        |--------------------------------------------------------------------------
        | 15. CLASSES DE COMPLEXITÉ
        |--------------------------------------------------------------------------
        */

        $complexiteClasses = [
            'Classe A' => $commandes
                ->filter(function ($commande) {

                    return strtolower(
                        trim($commande->complexite ?? '')
                    ) === 'classe a';

                })
                ->count(),

            'Classe B' => $commandes
                ->filter(function ($commande) {

                    return strtolower(
                        trim($commande->complexite ?? '')
                    ) === 'classe b';

                })
                ->count(),

            'Classe C' => $commandes
                ->filter(function ($commande) {

                    return strtolower(
                        trim($commande->complexite ?? '')
                    ) === 'classe c';

                })
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | 16. NC PAR CLASSE
        |--------------------------------------------------------------------------
        */

        $ncQualiteParClasse = [
            'mineure' => $ncQualite
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'mineure'
                )
                ->count(),

            'majeure' => $ncQualite
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'majeure'
                )
                ->count(),

            'critique' => $ncQualite
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'critique'
                )
                ->count(),
        ];

        $ncHseParClasse = [
            'mineure' => $ncHse
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'mineure'
                )
                ->count(),

            'majeure' => $ncHse
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'majeure'
                )
                ->count(),

            'critique' => $ncHse
                ->filter(fn ($nc) =>
                    strtolower(
                        trim($nc->classe ?? '')
                    ) === 'critique'
                )
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | 17. STATUTS DES PROJETS
        |--------------------------------------------------------------------------
        */

        $statutsProjets = [
            'Exécution' =>
                $totalProjetsActifs,

            'Hold' =>
                $totalProjetsSuspendus,

            'Clôture' =>
                $totalProjetsClotures,

            'Réception définitive' =>
                $totalProjetsReceptionDefinitive,
        ];

        /*
        |--------------------------------------------------------------------------
        | 18. RETOUR VERS LA VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboards.operationnel.index',
            compact(

                // Filtres
                'chefsProjet',
                'fournisseurs',
                'commandesListe',

                'chefProjetId',
                'commandeId',
                'fournisseurId',
                'periode',

                // Travaux
                'commandes',
                'totalProjetsActifs',
                'totalProjetsSuspendus',
                'totalProjetsClotures',
                'totalProjetsReceptionDefinitive',
                'totalProjetsEnRetard',
                'complexiteMoyenne',
                'joursRestantsMoyens',
                'avancementGlobal',
                'avancementParProjet',
                'projetsEnRetard',
                'statutsProjets',
                'complexiteClasses',

                // Bordereaux
                'montantTotalBordereau',
                'montantConsomme',
                'resteAConsommer',
                'tauxConsommation',

                // Personnel
                'totalPersonnel',
                'personnelActif',
                'totalHeures',
                'moyenneHeuresPersonne',

                // Engins
                'totalEngins',
                'enginsActifs',

                // Qualité / HSE
                'ncQualite',
                'ncHse',
                'ncQualiteParClasse',
                'ncHseParClasse'
            )
        );
    }
}