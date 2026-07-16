// Theme Toggle
document.addEventListener('DOMContentLoaded', function() {
    const themeBtn = document.getElementById('themeToggleBtn');
    const html = document.documentElement;
    
    // Récupérer le thème sauvegardé
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeBtn) {
        themeBtn.addEventListener('click', function() {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        if (themeBtn) {
            themeBtn.innerHTML = theme === 'dark' 
                ? '<i class="fa-solid fa-sun"></i>' 
                : '<i class="fa-solid fa-moon"></i>';
        }
    }

    // User Dropdown Toggle
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');
    
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
    }

    // Search Dropdown
    const searchInput = document.getElementById('globalSearch');
    const searchDropdown = document.getElementById('searchDropdown');
    
    if (searchInput && searchDropdown) {
        searchInput.addEventListener('focus', function() {
            if (this.value.length >= 2) {
                searchDropdown.classList.add('active');
            }
        });
        
        searchInput.addEventListener('blur', function() {
            setTimeout(() => {
                searchDropdown.classList.remove('active');
            }, 200);
        });
        
        searchInput.addEventListener('input', function() {
            if (this.value.length >= 2) {
                const results = [
                    { type: 'LB', key: 'LB-2025-001', label: 'Réfection route N6' },
                    { type: 'CMD', key: 'CMD-2025-0012', label: 'Commande EGTB' },
                    { type: 'PER', key: 'CC345678', label: 'Youssef Belkadi' }
                ];
                
                searchDropdown.innerHTML = results.map(item => `
                    <div class="search-dropdown-item" onclick="window.location.href='#'">
                        <span class="badge">${item.type}</span>
                        <span><strong>${item.key}</strong> — ${item.label}</span>
                    </div>
                `).join('');
                searchDropdown.classList.add('active');
            } else {
                searchDropdown.classList.remove('active');
            }
        });
    }
});