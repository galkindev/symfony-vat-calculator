/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

const calculationItems = document.getElementsByClassName('delete-calculation-button');

for (let i = 0, l = calculationItems.length; i < l; i++) {
    calculationItems[i].addEventListener('click', function (event) {
        event.preventDefault();

        if (confirm('Are you sure you want to delete this calculation item?')) {
            window.location.href = this.getAttribute('href');
        }
    });
}

const clearCalculationHistoryElement = document.getElementById('js-clear-calculation-history');

clearCalculationHistoryElement.addEventListener('click', function (event) {
    event.preventDefault();

    if (confirm('Are you sure you want to clear calculation history?')) {
        window.location.href = this.getAttribute('href');
    }
});
