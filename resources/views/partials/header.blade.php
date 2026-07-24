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

        <div class="search-dropdown"
             id="searchDropdown">
        </div>

    </div>


    <!-- Actions -->
    <div class="header-actions">


        <!-- Notifications -->
        <div class="dropdown-wrapper">

            @php

                $notifications = auth()->user()
                    ? auth()->user()
                        ->notifications()
                        ->latest()
                        ->take(5)
                        ->get()
                    : collect();

                $notificationsNonLues = auth()->user()
                    ? auth()->user()
                        ->unreadNotifications()
                        ->count()
                    : 0;

            @endphp


            <!-- Bouton cloche -->
            <button class="action-btn"
                    title="Notifications"
                    id="notifBtn">

                <i class="fas fa-bell"></i>

                @if($notificationsNonLues > 0)

                    <span class="notif-dot"></span>

                @endif

            </button>


            <!-- Menu notifications -->
            <div class="dropdown-menu dropdown-notif"
                 id="notifDropdown">


                <!-- Header -->
                <div class="dropdown-header">

                    <span>
                        Notifications
                    </span>


                    @if($notificationsNonLues > 0)

                        <span class="dropdown-badge">

                            {{ $notificationsNonLues }}

                            nouvelle{{ $notificationsNonLues > 1 ? 's' : '' }}

                        </span>

                    @else

                        <span class="dropdown-badge">

                            Aucune nouvelle

                        </span>

                    @endif

                </div>


                <!-- Liste -->
                <div class="dropdown-body">


                    @forelse($notifications as $notification)


                        <!-- Notification -->

                        <a href="{{ route('notifications.read', $notification->id) }}"
                           class="notif-item {{ $notification->read_at ? 'read' : 'unread' }}">


                            <!-- Icône -->

                            @if(($notification->data['type'] ?? '') === 'rapport_travaux')

                                <i class="fas fa-file-alt text-primary"></i>

                            @elseif(($notification->data['type'] ?? '') === 'formation')

                                <i class="fas fa-graduation-cap text-success"></i>

                            @elseif(($notification->data['type'] ?? '') === 'non_conformite')

                                <i class="fas fa-exclamation-triangle text-danger"></i>

                            @elseif(($notification->data['type'] ?? '') === 'plan_action')

                                <i class="fas fa-tasks text-warning"></i>

                            @else

                                <i class="fas fa-bell text-primary"></i>

                            @endif


                            <!-- Contenu -->

                            <div>

                                <div class="notif-title">

                                    {{ $notification->data['titre'] ?? 'Notification' }}

                                </div>


                                <div class="notif-message">

                                    {{ $notification->data['message'] ?? '' }}

                                </div>


                                <div class="notif-time">

                                    {{ $notification->created_at->diffForHumans() }}

                                </div>

                            </div>


                        </a>


                    @empty


                        <div class="notif-empty">

                            <i class="fas fa-bell-slash"></i>

                            <p>
                                Aucune notification
                            </p>

                        </div>


                    @endforelse
                </div>


                <!-- Footer -->

                <div class="dropdown-footer">

                    <a href="{{ route('notifications.index') }}">
                        Voir toutes les notifications
                    </a>

                </div>
            </div>

        </div>
        <!-- Theme Toggle -->

        <button class="action-btn"
                title="Mode sombre"
                id="themeToggleBtn">

            <i class="fas fa-moon"></i>
        </button>
    </div>

</header>