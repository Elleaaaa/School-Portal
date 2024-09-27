    // Get the input and button elements
    const studentIdInput = document.getElementById('studentId');
    const submitBtn = document.getElementById('submitBtn');

    // Add an event listener for the input field
    studentIdInput.addEventListener('input', function() {
        // Enable the submit button if there's text in the input
        if (studentIdInput.value.trim() !== '') {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    });