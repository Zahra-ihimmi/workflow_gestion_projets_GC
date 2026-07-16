<header class="header">
    <!-- Breadcrumb -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <i class="fas fa-home"></i>
        @yield('breadcrumb', '<span>Dashboard</span>')
    </nav>

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
        <button class="action-btn" title="Notifications" id="notifBtn">
            <i class="fas fa-bell"></i>
            <span class="notif-dot"></span>
        </button>
        
        <button class="action-btn" title="Mode sombre" id="themeToggleBtn">
            <i class="fas fa-moon"></i>
        </button>
        
        <div class="user-dropdown">
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
                <!-- Déconnexion sans route - utilise un lien simple -->
                <a href="#" class="dropdown-item text-danger" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</header>