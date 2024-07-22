document.addEventListener('DOMContentLoaded', function() {
    // Get the input field
    var studentIdInput = document.getElementById('studentId');

    // Add event listener for keypress event
    studentIdInput.addEventListener('keypress', function(event) {
        // Check if Enter key was pressed (key code 13)
        if (event.key === 'Enter') {
            // Prevent the default form submission behavior
            event.preventDefault();
            
            // Perform the same action as when the button is clicked
            var studentId = studentIdInput.value;
            fetchData(studentId);
        }
    });

    // Function to fetch student data
    function fetchData(studentId) {
        // AJAX request to fetch student data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/fetch-student-grade-level', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        
        // Retrieve CSRF token from a meta tag in the HTML
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var studentDetails = JSON.parse(xhr.responseText);
                    // Check if student details are found
                    if (studentDetails && Object.keys(studentDetails).length > 0) {
                        // Populate the details fields with the received data
                        document.querySelector('input[name="gradeLevel"]').value = studentDetails.gradeLevel;
                        document.querySelector('input[name="classType"]').value = studentDetails.classType;
                    } else {
                        // Clear the fields if no student is found
                        document.querySelector('input[name="gradeLevel"]').value = '';
                        document.querySelector('input[name="classType"]').value = '';
                    }
                } else if (xhr.status === 404) {
                    // Clear the fields if no student is found
                    document.querySelector('input[name="gradeLevel"]').value = '';
                    document.querySelector('input[name="classType"]').value = '';
                } else {
                    console.error('Error fetching student data');
                }
            }
        };
        xhr.send(JSON.stringify({ studentId: studentId }));
    }
});