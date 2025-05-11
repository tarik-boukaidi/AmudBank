document.addEventListener('DOMContentLoaded', function() {
    // Tab system initialization
    const tabLinks = document.querySelectorAll('.profile-menu a');
    
    // Function to activate a tab
    function activateTab(tabId) {
        // Remove active class from all
        tabLinks.forEach(l => l.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Activate the selected one
        const link = document.querySelector(`.profile-menu a[data-tab="${tabId}"]`);
        const tab = document.getElementById(tabId);
        
        if (link && tab) {
            link.classList.add('active');
            tab.classList.add('active');
            localStorage.setItem('menuactive', tabId);
        }
    }
    
    // Tab click handler
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            activateTab(this.getAttribute('data-tab'));
        });
    });
    
    // Check localStorage and activate saved tab
    const savedTab = localStorage.getItem('menuactive');
    if (savedTab) {
        activateTab(savedTab);
    } else {
        // Default to first tab if nothing saved
        activateTab(tabLinks[0].getAttribute('data-tab'));
    }
    
    // Rest of your code (switches, animations, etc.)
    const switches = document.querySelectorAll('.switch input');
    switches.forEach(sw => {
        // ... your existing switch code ...
    });
    

 }
 );

function animateBalance(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        element.textContent = '$' + current.toFixed(2);
        if (current >= target) {
            element.textContent = '$' + target.toFixed(2);
            clearInterval(timer);
        }
    }, 10);

}
function handleLogout(event) {
    event.preventDefault();

    // Définir 'menuactive' dans localStorage
    localStorage.setItem('menuactive', 'overview');

    // Soumettre le formulaire de logout
    document.getElementById('logout-form').submit();
}
