import html2pdf from 'html2pdf.js';

(() => {
    const savePdfButton = document.getElementById('save-pdf');

    if (!savePdfButton)
        return;
    
    savePdfButton.addEventListener('click', () => {
        const element = document.getElementById('invoice-container');
        const filename = savePdfButton.getAttribute('data-name') || 'invoice.pdf';

        const options = {
            filename: filename,
            html2canvas: { scale: 2 },
            image: { type: 'jpeg', quality: 0.98 },
            jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }
        }

        html2pdf().from(element).set(options).save();
    });
})();