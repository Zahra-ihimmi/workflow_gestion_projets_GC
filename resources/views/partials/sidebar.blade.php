<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="logo">
            <i class="fa-solid fa-building"></i>
            <span>Workflow</span>
        </div>
    </div>

    <!-- User Info -->
    <!-- User Info -->
<div class="sidebar-user">
    

    <div class="user-info">
        <span class="user-name">
            {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
        </span>

        <span class="user-email">
            {{ Auth::user()->email }}
        </span>
    </div>
</div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <ul>
            <li class="menu-title">
                <i class="fa-solid fa-chart-line"></i>
                <span>Tableaux de bord</span>
            </li>
            <li>
                <a href="{{ route('dashboard.strategique') }}">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Dashboard Stratégique</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.analytique') }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard Analytique</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.operationnel') }}">
                    <i class="fa-solid fa-chart-area"></i>
                    <span>Dashboard Opérationnel</span>
                </a>
            </li>

            <li class="menu-title">
                <i class="fa-solid fa-wallet"></i>
                <span>Gestion budgétaire</span>
            </li>
            <li>
                <a href="{{ route('ligne-budgetaires.index') }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Lignes budgétaires</span>
                </a>
            </li>
            <li>
                <a href="{{ route('demande-achats.index') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Demandes d'achat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('commandes.index') }}">
                    <i class="fa-solid fa-file-signature"></i>
                    <span>Commandes</span>
                </a>
            </li>

            <li class="menu-title">
                <i class="fa-solid fa-helmet-safety"></i>
                <span>Suivi des travaux</span>
            </li>
            <li>
                <a href="{{ route('prix.index') }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Prix</span>
                </a>
            </li>
            <li>
                <a href="{{ route('plannings.index') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Planning</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rapport-travaux.index') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Rapports travaux</span>
                </a>
            </li>
            

            <li class="menu-title">
                <i class="fa-solid fa-coins"></i>
                <span>Suivi financier</span>
            </li>
            <li>
                <a href="{{ route('decomptes.index') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Décomptes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('factures.index') }}">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span>Factures</span>
                </a>
            </li>

            <li class="menu-title">
                <i class="fa-solid fa-shield-halved"></i>
                <span>HSE & Qualité</span>
            </li>
            <li>
                <a href="{{ route('non-conformites.index') }}">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Non-conformités</span>
                </a>
            </li>
            <li>
                <a href="{{ route('plan-actions.index') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Plans d'action</span>
                </a>
            </li>

            <li class="menu-title">
                <i class="fa-solid fa-users"></i>
                <span>Ressources</span>
            </li>
            <li>
                <a href="{{ route('fournisseurs.index') }}">
                    <i class="fa-solid fa-building"></i>
                    <span>Fournisseurs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('personnels.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Personnel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formations.index') }}">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Formations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('habilitations.index') }}">
                    <i class="fa-solid fa-id-card"></i>
                    <span>Habilitations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pointages.index') }}">
                    <i class="fa-solid fa-clock"></i>
                    <span>Pointages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('vehicules.index') }}">
                    <i class="fa-solid fa-truck"></i>
                    <span>Véhicules</span>
                </a>
            </li>
            <li>
                <a href="{{ route('assurances.index') }}">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Assurances</span>
                </a>
            </li>

            <li class="menu-title logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>