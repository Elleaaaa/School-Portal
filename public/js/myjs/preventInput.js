document.addEventListener('DOMContentLoaded', function() {
    var amountInput = document.getElementById('amount');
    var DAInput = document.getElementById('discountAmount');
    var DPInput = document.getElementById('discountedPrice');

    // Prevent user input events
    amountInput.addEventListener('keydown', function(event) {
        event.preventDefault();
    });
    DAInput.addEventListener('keydown', function(event) {
        event.preventDefault();
    });
    DPInput.addEventListener('keydown', function(event) {
        event.preventDefault();
    });

    amountInput.addEventListener('mousedown', function(event) {
        event.preventDefault();
    });
    DAInput.addEventListener('mousedown', function(event) {
        event.preventDefault();
    });
    DPInput.addEventListener('mousedown', function(event) {
        event.preventDefault();
    });

    amountInput.addEventListener('touchstart', function(event) {
        event.preventDefault();
    });
    DAInput.addEventListener('touchstart', function(event) {
        event.preventDefault();
    });
    DPInput.addEventListener('touchstart', function(event) {
        event.preventDefault();
    });
});