  // JavaScript code to fetch sections based on selected grade level
  document.getElementById('gradeLevel').addEventListener('change', function() {
    var gradeLevel = this.value;
    var sectionSelect = document.getElementById('section');
    
    // Clear existing options
    sectionSelect.innerHTML = '<option value="">Loading...</option>';
    
    // Fetch sections based on selected grade level
    fetch('/fetch-sections?gradeLevel=' + encodeURIComponent(gradeLevel))
        .then(response => response.json())
        .then(section => {
            // Populate section options
            sectionSelect.innerHTML = '<option value="">Select Section</option>';
            section.forEach(section => {
                    var option = document.createElement('option');
                    option.value = section.sectionName;
                    option.text = section.sectionName;
                    sectionSelect.appendChild(option);
                });
        })
        .catch(error => {
            console.error('Error fetching sections:', error);
            sectionSelect.innerHTML = '<option value="">No Section Available</option>';
        });
});