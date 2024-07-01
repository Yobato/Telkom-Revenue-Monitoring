document.addEventListener('DOMContentLoaded', function () {
        formatCurrencyOnLoad();
    });

    function formatCurrencyOnLoad() {
        let currencyElements = document.getElementsByClassName('currency-field');

        for (let i = 0; i < currencyElements.length; i++) {
            let rawValue = currencyElements[i].textContent.replace(/[^\d]/g, '');

            if (rawValue) {
                let formattedValue = 'Rp.' + Number(rawValue).toLocaleString('id-ID');
                currencyElements[i].textContent = formattedValue;
            }
        }
    }