function hideAlerts() {
    setTimeout(function() {
        var successAlert = document.getElementById('successAlert');
        var failedAlert = document.getElementById('failedAlert');

        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (failedAlert) {
            failedAlert.style.display = 'none';
        }
    }, 5000); // Adjust the time here (in milliseconds)
}

// Call the timer function when the page loads
window.onload = function() {
    hideAlerts();
};