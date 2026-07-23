<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Workflow Génie Civil')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 (version gratuite) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const successMessage = document.getElementById('success-message');

        if (successMessage) {

            setTimeout(function () {

                successMessage.style.opacity = '0';

                setTimeout(function () {
                    successMessage.remove();
                }, 500);

            }, 3000);

        }

    });
</script>
<body>

    <div id="app">
        @include('partials.sidebar')
        
        <div class="main-content">
            @include('partials.header')
            
            <main class="content">
                {{-- MESSAGE DE SUCCÈS GLOBAL --}}
                    @if(session('success'))
                        <div id="success-message" class="success-card">
                            <div class="success-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>

                            <div class="success-text">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                @yield('content')
            </main>
            
            @include('partials.footer')
        </div>
    </div>
    {{-- MODAL GLOBALE DE SUPPRESSION --}}
    <div id="deleteModal" class="delete-modal">

        <div class="delete-modal-content">

            <div class="delete-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <h3>Confirmation de suppression</h3>

            <p>
                Êtes-vous sûr de vouloir supprimer cet élément ?
            </p>

            <span>
                Cette action est irréversible.
            </span>

            <div class="delete-actions">

                <button type="button"
                        class="btn-cancel"
                        onclick="closeDeleteModal()">
                    Annuler
                </button>

                <button type="button"
                        class="btn-confirm-delete"
                        onclick="submitDelete()">
                    Oui, supprimer
                </button>

            </div>

        </div>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- SCRIPT DE SUPPRESSION GLOBAL --}}
    <script>

        let deleteForm = null;

        function confirmDelete(id) {

            deleteForm = document.getElementById('delete-form-' + id);

            document.getElementById('deleteModal').style.display = 'flex';

        }


        function closeDeleteModal() {

            document.getElementById('deleteModal').style.display = 'none';

            deleteForm = null;

        }


        function submitDelete() {

            if (deleteForm) {

                deleteForm.submit();

            }

        }


        // Fermer en cliquant à l'extérieur
        document.getElementById('deleteModal').addEventListener('click', function(event) {

            if (event.target === this) {

                closeDeleteModal();

            }

        });

    </script>
    @stack('scripts')
</body>
</html>