   // JavaScript code to fetch subjects based on selected grade level
   document.getElementById('gradeLevel').addEventListener('change', function() {
    var gradeLevel = this.value;
    var subjectSelect = document.getElementById('subject');
    
    // Clear existing options
    subjectSelect.innerHTML = '<option value="">Loading...</option>';
    
    // Fetch subjects based on selected grade level
    fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel))
        .then(response => response.json())
        .then(subjects => {
            // Populate subject options
            subjectSelect.innerHTML = '<option value="">Select Subject</option>';
            subjects.forEach(subject => {
                var option = document.createElement('option');
                option.value = subject.subject;
                option.text = subject.subject;
                subjectSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
            subjectSelect.innerHTML = '<option value="">No Subject Available</option>';
        });
});