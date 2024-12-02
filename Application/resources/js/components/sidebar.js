(() => {
    const sidebar_id = 'dropdown-layouts';
    const dropdown = document.getElementById(sidebar_id);
    
    document.getElementById(sidebar_id).addEventListener('click', function() {
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    });
})();