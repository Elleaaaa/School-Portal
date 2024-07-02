document.getElementById('gradeLevel').addEventListener('change', function() {
    var gradeLevel = this.value;
    
    // Make AJAX request to fetch subjects based on grade level
    fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel))
        .then(response => response.json())
        .then(data => {
            // Clear existing subjects
            var subjectContainer = document.getElementById('subjectContainer');
            subjectContainer.innerHTML = '';

            // Initialize an array to store selected subjects
            var selectedSubjects = [];

            // Check if subjects are found
            if (data.length > 0) {
                // Create checkboxes for each subject
                data.forEach(subject => {
                    var subjectDiv = document.createElement('div'); // Create a div for each checkbox-label pair
                    
                    var checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'subjects[]'; // Use an array for multiple selections
                    checkbox.value = subject.id;
                    checkbox.checked = true; // Auto-check the checkbox
                    
                    var label = document.createElement('label');
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(subject.subjectTitle));
                    label.classList.add('subject-label'); // Add a class for styling
                    
                    // Append checkbox and label to div
                    subjectDiv.appendChild(label);
                    subjectContainer.appendChild(subjectDiv); // Append div to container

                    // Add the subject to the selectedSubjects array
                    selectedSubjects.push(subject.subjectTitle);
                });
            } else {
                // No subjects found, display message
                subjectContainer.textContent = 'No Subject Found';
            }

            // Set the value of the selectedSubjects input field
            document.getElementById('selectedSubjects').value = selectedSubjects.join(', ');
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
        });
});