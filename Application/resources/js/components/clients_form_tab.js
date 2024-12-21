(() => {
    const tabs = document.querySelectorAll('.clients-form-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabFor = this.getAttribute('data-for');
            showInput(tabFor);
        });
    });

    const showInput = inputId => {
        const inputs = document.querySelectorAll('#detailsGeneral, #contactPersons');
        inputs.forEach(input => {
            input.classList.add('hidden'); 
        });

        const selectedInput = document.getElementById(inputId);
        if (selectedInput) {
            selectedInput.classList.remove('hidden'); 
        }
    }
})();