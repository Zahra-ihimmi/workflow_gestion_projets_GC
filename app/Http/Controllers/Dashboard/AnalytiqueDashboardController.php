<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LigneBudgetaire;
use App\Models\Fournisseur;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalytiqueDashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTRES
        |--------------------------------------------------------------------------
        */

        $projetId = $request->input('projet_id');

        $client = $request->input('client');

        $fournisseurId = $request->input('fournisseur_id');

        $chefProjetId = $request->input('chef_projet_id');

        $commandeId = $request->input('commande_id');

        $periode = $request->input(
            'periode',
            'annee_courante'
        );


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS
        |--------------------------------------------------------------------------
        */

        $projets = LigneBudgetaire::query()
            ->orderBy('intitule')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES CLIENTS
        |--------------------------------------------------------------------------
        */

        $clients = LigneBudgetaire::query()
            ->whereNotNull('client')
            ->where('client', '!=', '')
            ->distinct()
            ->orderBy('client')
            ->pluck('client');


        /*
        |--------------------------------------------------------------------------
        | LISTE DES FOURNISSEURS
        |--------------------------------------------------------------------------
        */

        $fournisseurs = Fournisseur::query()
            ->orderBy('nom')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES CHEFS DE PROJET
        |--------------------------------------------------------------------------
        |
        | Le chef de projet est lié à la LB via utilisateur_id.
        |
        */

        $chefsProjet = Utilisateur::query()
            ->orderBy('nom')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES COMMANDES
        |--------------------------------------------------------------------------
        */

        $commandesListe = \App\Models\Commande::query()
            ->orderBy('code')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | REQUÊTE PRINCIPALE
        |--------------------------------------------------------------------------
        */

        $query = LigneBudgetaire::with([
            'utilisateur',
            'demandesAchats.commande.fournisseur',
            'demandesAchats.commande.prix',
            'demandesAchats.commande.decomptes',
            'demandesAchats.commande.decomptes.facture',
        ]);


        /*
        |--------------------------------------------------------------------------
        | FILTRE PROJET
        |--------------------------------------------------------------------------
        */

        if ($projetId) {

            $query->where(
                'id',
                $projetId
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE CLIENT
        |--------------------------------------------------------------------------
        */

        if ($client) {

            $query->where(
                'client',
                $client
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE CHEF DE PROJET
        |--------------------------------------------------------------------------
        */

        if ($chefProjetId) {

            $query->where(
                'utilisateur_id',
                $chefProjetId
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE PÉRIODE
        |--------------------------------------------------------------------------
        */

        switch ($periode) {

            case 'mois_courant':

                $query
                    ->whereYear(
                        'date_objective',
                        now()->year
                    )
                    ->whereMonth(
                        'date_objective',
                        now()->month
                    );

                break;


            case 'trimestre_courant':

                $query->whereBetween(
                    'date_objective',
                    [
                        now()->startOfQuarter(),
                        now()->endOfQuarter()
                    ]
                );

                break;


            case 'annee_precedente':

                $query->whereYear(
                    'date_objective',
                    now()->year - 1
                );

                break;


            case 'annee_courante':

                $query->whereYear(
                    'date_objective',
                    now()->year
                );

                break;


            case 'annee_prochaine':

                $query->whereYear(
                    'date_objective',
                    now()->year + 1
                );

                break;


            case 'toutes':

                break;

        }


        /*
        |--------------------------------------------------------------------------
        | RÉCUPÉRATION DES LIGNES BUDGÉTAIRES
        |--------------------------------------------------------------------------
        */

        $lignesBudgetaires = $query->get();


        /*
        |--------------------------------------------------------------------------
        | FILTRE FOURNISSEUR
        |--------------------------------------------------------------------------
        */

        if ($fournisseurId) {

            $lignesBudgetaires = $lignesBudgetaires
                ->filter(function ($lb) use ($fournisseurId) {

                    return $lb->demandesAchats
                        ->contains(function ($da) use ($fournisseurId) {

                            return optional(
                                $da->commande
                            )->fournisseur_id == $fournisseurId;

                        });

                })
                ->values();

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE COMMANDE
        |--------------------------------------------------------------------------
        */

        if ($commandeId) {

            $lignesBudgetaires = $lignesBudgetaires
                ->filter(function ($lb) use ($commandeId) {

                    return $lb->demandesAchats
                        ->contains(function ($da) use ($commandeId) {

                            return optional(
                                $da->commande
                            )->id == $commandeId;

                        });

                })
                ->values();

        }


        /*
        |--------------------------------------------------------------------------
        | KPI : NOMBRE TOTAL DE PROJETS
        |--------------------------------------------------------------------------
        */

        $totalProjets = $lignesBudgetaires->count();


        /*
        |--------------------------------------------------------------------------
        | KPI : NOMBRE PAR TYPE
        |--------------------------------------------------------------------------
        */

        $nombreCapex = $lignesBudgetaires
            ->where('type', 'CAPEX')
            ->count();

        $nombreOpex = $lignesBudgetaires
            ->where('type', 'OPEX')
            ->count();

        $nombrePdr = $lignesBudgetaires
            ->where('type', 'PDR')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | KPI : MONTANT ENVELOPPE BUDGÉTAIRE
        |--------------------------------------------------------------------------
        |
        | Montant LB
        |
        */

        $montantEnveloppeBudgetaire = $lignesBudgetaires
            ->sum('montant_estimatif');

        $budgetTotal = $montantEnveloppeBudgetaire;
        /*
        |--------------------------------------------------------------------------
        | CALCUL DES DA
        |--------------------------------------------------------------------------
        */

        $demandesAchats = $lignesBudgetaires
            ->flatMap(function ($lb) {

                return $lb->demandesAchats;

            });


        $nombreDA = $demandesAchats->count();


        /*
        |--------------------------------------------------------------------------
        | CALCUL DES COMMANDES
        |--------------------------------------------------------------------------
        */

        $commandes = $demandesAchats
            ->map(function ($da) {

                return $da->commande;

            })
            ->filter();
        $nombreCommandes = $commandes->count();

        /*
        |--------------------------------------------------------------------------
        | MONTANT ENGAGÉ
        |--------------------------------------------------------------------------
        |
        | Montant total des CMD
        |
        */

        $montantEngage = $commandes
            ->sum('montant_ht');


        /*
        |--------------------------------------------------------------------------
        | CONSOMMATION LB
        |--------------------------------------------------------------------------
        |
        | Montant total des CMD liées
        |
        */

        $consommationLB = $commandes
            ->sum('montant_ht');


        /*
        |--------------------------------------------------------------------------
        | RESTE LB
        |--------------------------------------------------------------------------
        */

        $resteLB = $montantEnveloppeBudgetaire
            - $consommationLB;


        /*
        |--------------------------------------------------------------------------
        | DÉCOMPTES
        |--------------------------------------------------------------------------
        */

        $decomptes = $commandes
            ->flatMap(function ($commande) {

                return $commande->decomptes;

            });


        /*
        |--------------------------------------------------------------------------
        | MONTANT ATTACHÉ
        |--------------------------------------------------------------------------
        |
        | Quantité attachée SES × Prix unitaire PRX
        |
        */

        $montantAttache = 0;


        foreach ($decomptes as $decompte) {

            $commande = $decompte->commande;

            if (!$commande) {
                continue;
            }

            /*
            |--------------------------------------------------------------
            | Recherche du prix correspondant
            |--------------------------------------------------------------
            |
            | Le décompte et le prix appartiennent à la même commande.
            |
            | On utilise ici la désignation pour identifier
            | le prix correspondant au décompte.
            |
            */

            $prix = $commande->prix
                ->firstWhere(
                    'designation',
                    $decompte->designation
                );


            if ($prix) {

                $montantAttache +=

                    $decompte->quantite_attachee

                    *

                    $prix->prix_unitaire;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | MONTANT EN ATTENTE DE FACTURATION
        |--------------------------------------------------------------------------
        |
        | Montant attaché des décomptes
        | dont le statut est "attente validation"
        |
        */

        $montantAttenteFacturation = 0;


        foreach (
            $decomptes->where(
                'statut_validation',
                'attente validation'
            )
            as $decompte
        ) {

            $commande = $decompte->commande;

            if (!$commande) {
                continue;
            }


            $prix = $commande->prix
                ->firstWhere(
                    'designation',
                    $decompte->designation
                );


            if ($prix) {

                $montantAttenteFacturation +=

                    $decompte->quantite_attachee

                    *

                    $prix->prix_unitaire;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | FACTURES
        |--------------------------------------------------------------------------
        */

        $factures = $decomptes
            ->map(function ($decompte) {

                return $decompte->facture;

            })
            ->filter();


        /*
        |--------------------------------------------------------------------------
        | MONTANT PAYÉ
        |--------------------------------------------------------------------------
        |
        | Montant facturé
        |
        */

        $montantPaye = $factures
            ->sum('montant');


        /*
        |--------------------------------------------------------------------------
        | NOMBRE TOTAL DE FACTURES
        |--------------------------------------------------------------------------
        */

        $nombreFacturesTotal = $factures
            ->count();


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DE FACTURES ÉCHUES
        |--------------------------------------------------------------------------
        */

        $nombreFacturesEchues = $factures
            ->filter(function ($facture) {

                $decompte = $facture->decompte;

                if (!$decompte) {
                    return false;
                }


                $commande = $decompte->commande;

                if (!$commande) {
                    return false;
                }


                /*
                |----------------------------------------------------------
                | Extraction du nombre de jours
                |----------------------------------------------------------
                |
                | Exemple :
                | "30 jours" → 30
                |
                */

                preg_match(
                    '/\d+/',
                    $commande->mode_facturation,
                    $matches
                );


                if (!isset($matches[0])) {
                    return false;
                }


                $nombreJours = (int) $matches[0];


                $dateEcheance = Carbon::parse(
                    $facture->date_depot
                )->addDays(
                    $nombreJours
                );


                return now()->greaterThan(
                    $dateEcheance
                );

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DE DÉCOMPTES EN ATTENTE DE VALIDATION
        |--------------------------------------------------------------------------
        */

        $nombreDecomptesAttenteValidation = $decomptes
            ->where(
                'statut_validation',
                'attente validation'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | DISTRIBUTION DES PAIEMENTS PAR MOIS
        |--------------------------------------------------------------------------
        */

        $paiementsParMois = array_fill(
            1,
            12,
            0
        );


        foreach ($factures as $facture) {

            $mois = Carbon::parse(
                $facture->date_depot
            )->month;


            $paiementsParMois[$mois] +=
                (float) $facture->montant;

        }


        /*
        |--------------------------------------------------------------------------
        | BUDGET RESTANT
        |--------------------------------------------------------------------------
        */

        $budgetRestant = $resteLB;


        /*
        |--------------------------------------------------------------------------
        | TAUX D'ENGAGEMENT
        |--------------------------------------------------------------------------
        */

        $tauxEngagement =

            $montantEnveloppeBudgetaire > 0

            ? (
                $montantEngage
                /
                $montantEnveloppeBudgetaire
            ) * 100

            : 0;


        /*
        |--------------------------------------------------------------------------
        | PROJETS LANCÉS
        |--------------------------------------------------------------------------
        */

        $projetsLances = $lignesBudgetaires
            ->filter(function ($lb) {

                return $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PROJETS À LANCER
        |--------------------------------------------------------------------------
        */

        $projetsALancer = $totalProjets
            - $projetsLances;


        /*
        |--------------------------------------------------------------------------
        | PROJETS EN RETARD
        |--------------------------------------------------------------------------
        */

        $projetsEnRetard = $lignesBudgetaires
            ->filter(function ($lb) {

                if (!$lb->date_objective) {

                    return false;

                }


                $dateObjectif = Carbon::parse(
                    $lb->date_objective
                );


                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });


                return $dateObjectif->isPast()
                    && !$estLance;

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS EN RETARD
        |--------------------------------------------------------------------------
        */

        $listeProjetsEnRetard = $lignesBudgetaires
            ->filter(function ($lb) {

                if (!$lb->date_objective) {

                    return false;

                }


                $dateObjectif = Carbon::parse(
                    $lb->date_objective
                );


                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });


                return $dateObjectif->isPast()
                    && !$estLance;

            })
            ->sortBy('date_objective');


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS À LANCER
        |--------------------------------------------------------------------------
        */

        $listeProjetsALancer = $lignesBudgetaires
            ->filter(function ($lb) {

                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });


                return !$estLance;

            })
            ->sortBy('date_objective');


        /*
        |--------------------------------------------------------------------------
        | RETOUR À LA VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboards.analytique.index',
            compact(

                'projets',

                'clients',

                'fournisseurs',

                'chefsProjet',

                'commandesListe',

                'lignesBudgetaires',

                'projetId',

                'client',

                'fournisseurId',

                'chefProjetId',

                'commandeId',

                'periode',

                'totalProjets',

                'nombreCapex',

                'nombreOpex',

                'nombrePdr',

                'montantEnveloppeBudgetaire',

                'demandesAchats',

                'nombreDA',

                'commandes',

                'nombreCommandes',

                'montantEngage',

                'consommationLB',

                'resteLB',

                'budgetRestant',

                'tauxEngagement',

                'montantAttache',

                'montantPaye',

                'montantAttenteFacturation',

                'nombreFacturesTotal',

                'nombreFacturesEchues',

                'nombreDecomptesAttenteValidation',

                'paiementsParMois',

                'projetsLances',

                'projetsALancer',

                'projetsEnRetard',

                'listeProjetsEnRetard',

                'listeProjetsALancer',
                'budgetTotal'

            )
        );
    }
}