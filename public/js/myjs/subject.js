document.getElementById('gradeLevel').addEventListener('change', function() {
    fetchSubjects();
});

document.getElementById('section').addEventListener('change', function() {
    fetchSubjects();
});

function fetchSubjects() {
    var gradeLevel = document.getElementById('gradeLevel').value;
    var section = document.getElementById('section').value;
    var subjectSelect = document.getElementById('subject');

    // Clear existing options and show loading text
    subjectSelect.innerHTML = '<option value="">Loading...</option>';

    if (gradeLevel && section) {
        // Fetch subjects based on selected grade level and section
        fetch(`/fetch-subjects?gradeLevel=${encodeURIComponent(gradeLevel)}&section=${encodeURIComponent(section)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(subjects => {
            console.log('Subjects:', subjects); // Log the subjects to see what is being returned
            subjectSelect.innerHTML = '<option value="">Select Subject</option>';
    
            if (subjects.length > 0) {
                subjects.forEach(subject => {
                    var option = document.createElement('option');
                    option.value = subject.subject;
                    option.text = subject.subject;
                    subjectSelect.appendChild(option);
                });
            } else {
                subjectSelect.innerHTML = '<option value="">No Subject Available</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
            subjectSelect.innerHTML = '<option value="">No Subject Available</option>';
        });
    
    } else {
        // Reset the subjects dropdown if grade level and section are not selected
        subjectSelect.innerHTML = '<option value="">Select Grade Level and Section first</option>';
    }
}
