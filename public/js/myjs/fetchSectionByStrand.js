document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('strand').addEventListener('change', function() {
        var strand = this.value;
        var gradeLevel = document.getElementById('gradeLevel').value; // Ensure gradeLevel has a value
        var sectionSelect = document.getElementById('section');
        
        // Show loading option
        sectionSelect.innerHTML = '<option value="">Loading...</option>';
        
        fetch('/fetch-sectionsbystrand?strand=' + encodeURIComponent(strand) + '&gradeLevel=' + encodeURIComponent(gradeLevel))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(sections => {
                sectionSelect.innerHTML = '<option value="">Select Section</option>';
                
                // Check if there are any sections
                if (sections.length > 0) {
                    sections.forEach(section => {
                        var option = document.createElement('option');
                        option.value = section.sectionName;
                        option.text = section.sectionName;
                        sectionSelect.appendChild(option);
                    });
                } else {
                    sectionSelect.innerHTML = '<option value="">No Section Available</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching sections:', error);
                sectionSelect.innerHTML = '<option value="">No Section Available</option>';
            });
    });
});
