@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="page-header">

    <div>
        <h1>Notifications</h1>
        <p>Consultez toutes vos notifications.</p>
    </div>

</div>


<div class="notifications-page">

    @forelse($notifications as $notification)

        <a href="{{ route('notifications.read', $notification->id) }}"
           class="notification-card
           {{ $notification->read_at ? 'read' : 'unread' }}">

            <div class="notification-icon">

                @if(($notification->data['type'] ?? '') === 'rapport_travaux')

                    <i class="fas fa-file-alt"></i>

                @elseif(($notification->data['type'] ?? '') === 'formation')

                    <i class="fas fa-graduation-cap"></i>

                @elseif(($notification->data['type'] ?? '') === 'non_conformite')

                    <i class="fas fa-exclamation-triangle"></i>

                @elseif(($notification->data['type'] ?? '') === 'plan_action')

                    <i class="fas fa-tasks"></i>

                @else

                    <i class="fas fa-bell"></i>

                @endif

            </div>


            <div class="notification-content">

                <div class="notification-title">

                    {{ $notification->data['titre'] ?? 'Notification' }}

                </div>

                <div class="notification-message">

                    {{ $notification->data['message'] ?? '' }}

                </div>

                <div class="notification-time">

                    {{ $notification->created_at->diffForHumans() }}

                </div>

            </div>


            @if(!$notification->read_at)

                <span class="notification-status">
                    Non lue
                </span>

            @endif

        </a>

    @empty

        <div class="notifications-empty">

            <i class="fas fa-bell-slash"></i>

            <h3>Aucune notification</h3>

            <p>Vous n'avez aucune notification pour le moment.</p>

        </div>

    @endforelse

</div>

@endsection