document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    
    // Ajouter l'attribut data-title pour les tooltips
    document.querySelectorAll('.sidebar-nav ul li a').forEach(link => {
        const span = link.querySelector('span');
        if (span) {
            link.setAttribute('data-title', span.textContent);
        }
    });

    // Gestion du logout (sidebar)
    const sidebarLogoutBtn = document.getElementById('sidebarLogoutBtn');
    if (sidebarLogoutBtn) {
        sidebarLogoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
                window.location.href = '/logout';
            }
        });
    }

    // Gestion du logout (header)
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
                window.location.href = '/logout';
            }
        });
    }

    // Marquer le lien actif
    const currentUrl = window.location.href;
    const links = document.querySelectorAll('.sidebar-nav ul li a');
    
    links.forEach(link => {
        if (link.getAttribute('href') && currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });
});