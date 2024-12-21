document.querySelectorAll('[data-tooltip-target]').forEach((element) => {
    const tooltipId = element.getAttribute('data-tooltip-target');
    const tooltip = document.getElementById(tooltipId);
    element.addEventListener('mouseenter', () => {
        tooltip.classList.remove('invisible', 'opacity-0');
        tooltip.classList.add('visible', 'opacity-100');
    });
    element.addEventListener('mouseleave', () => {
        tooltip.classList.remove('visible', 'opacity-100');
        tooltip.classList.add('invisible', 'opacity-0');
    });
});