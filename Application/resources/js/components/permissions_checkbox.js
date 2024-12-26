(() => {
    const adminCheckbox = document.getElementById('permissions-admin');
    const permissionsCheckboxes = document.querySelectorAll('.permissions-checkbox');

    if(!adminCheckbox) {
        return;
    }

    // Disable all permissions checkboxes if admin is checked (initialize)
    if(adminCheckbox.checked) {
        permissionsCheckboxes.forEach(checkbox => {
            checkbox.disabled = true;
            checkbox.checked = false;
        });
    }

    adminCheckbox.addEventListener('change', () => {
        if(adminCheckbox.checked) {
            permissionsCheckboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
        } else {
            permissionsCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        }
    });
})();