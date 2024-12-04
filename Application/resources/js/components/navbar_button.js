(() => {
    const sidebar = document.getElementById('sidebar');
    const hamburgerIcon = document.getElementById('toggleSidebarMobileHamburger');
    const closeIcon = document.getElementById('toggleSidebarMobileClose');

    document.getElementById('toggleSidebarMobileHamburger').addEventListener('click', () => {
        sidebar.classList.remove('hidden');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    });

    document.getElementById('toggleSidebarMobileClose').addEventListener('click', () => {
        sidebar.classList.add('hidden');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    });
})();
