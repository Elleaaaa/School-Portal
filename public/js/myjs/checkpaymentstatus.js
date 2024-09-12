document.getElementById('studentId').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent default Enter key behavior
        checkPaymentStatus(); // Call the function to handle the fetch request
    }
});

function checkPaymentStatus() {
    const studentId = document.getElementById('studentId').value;
    const token = document.querySelector('input[name="_token"]').value;

    fetch('/check-payment-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ studentId: studentId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message); // Show the alert with the message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while checking payment status.'); // Show alert for errors
    });
}
