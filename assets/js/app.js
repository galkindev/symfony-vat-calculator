/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

function handleDeleteAction(event) {
    event.preventDefault();

    let message = this.getAttribute('data-message');

    if (confirm(message)) {
        window.location.href = this.getAttribute('href');
    }
}

const calculationItems = document.getElementsByClassName('delete-calculation-item');

for (let i = 0; i < calculationItems.length; i++) {
    calculationItems[i].addEventListener('click', handleDeleteAction);
}

const clearCalculationHistoryElement = document.getElementById('js-clear-calculation-history');
clearCalculationHistoryElement.addEventListener('click', handleDeleteAction);
