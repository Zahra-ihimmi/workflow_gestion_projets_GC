<header class="header">
    <!-- Breadcrumb -->
    

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

    </div>
</header>