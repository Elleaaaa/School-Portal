function toggleStatus(id, currentStatus) {
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send an AJAX request to update the status
    fetch(`/toggle-status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: currentStatus })
    })
    .then(response => response.json())
    .then(data => {
        // Update the button color and text based on the new status
        const button = document.getElementById(`statusButton${id}`);
        if (data.status === 'active') {
            button.classList.remove('bg-danger');
            button.classList.add('bg-success');
            button.textContent = ''; 
        } else {
            button.classList.remove('bg-success');
            button.classList.add('bg-danger');
            button.textContent = '';
        }
    })
    .catch(error => console.error('Error:', error));
}
