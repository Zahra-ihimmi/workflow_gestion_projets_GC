<header class="header">
    <!-- Breadcrumb -->
    <div class="breadcrumb-wrapper">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <i class="fas fa-home"></i>
            @yield('breadcrumb', '<span>Dashboard</span>')
        </nav>
    </div>

    <!-- Search -->
    <div class="header-search">
        <i class="fas fa-search search-icon"></i>
        <input type="text" 
               placeholder="Rechercher..." 
               id="globalSearch"
               class="search-input"
               autocomplete="off">
        <div class="search-dropdown" id="searchDropdown"></div>
    </div>

    <!-- Actions -->
    <div class="header-actions">
        <!-- Notifications -->
        <div class="dropdown-wrapper">
            <button class="action-btn" title="Notifications" id="notifBtn">
                <i class="fas fa-bell"></i>
                <span class="notif-dot"></span>
            </button>
            <div class="dropdown-menu dropdown-notif" id="notifDropdown">
                <div class="dropdown-header">
                    <span>Notifications</span>
                    <span class="dropdown-badge">3 nouvelles</span>
                </div>
                <div class="dropdown-body">
                    <div class="notif-item">
                        <i class="fas fa-file-invoice text-primary"></i>
                        <div>
                            <div class="notif-title">Nouvelle DA</div>
                            <div class="notif-time">Il y a 5 min</div>
                        </div>
                    </div>
                    <div class="notif-item">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <div>
                            <div class="notif-title">NC critique signalée</div>
                            <div class="notif-time">Il y a 2h</div>
                        </div>
                    </div>
                    <div class="notif-item">
                        <i class="fas fa-check-circle text-success"></i>
                        <div>
                            <div class="notif-title">Décompte validé</div>
                            <div class="notif-time">Il y a 4h</div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-footer">
                    <a href="#">Voir toutes les notifications</a>
                </div>
            </div>
        </div>

        <!-- Theme Toggle -->
        <button class="action-btn" title="Mode sombre" id="themeToggleBtn">
            <i class="fas fa-moon"></i>
        </button>

        <!-- User Dropdown -->
        <div class="dropdown-wrapper user-dropdown">
            <button class="user-btn" id="userMenuBtn">
                <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}" 
                     alt="User" 
                     class="user-avatar-small">
                <span class="user-name-small">{{ Auth::user()->name ?? 'Admin' }}</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu" id="userDropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> Profil
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-danger" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</header>