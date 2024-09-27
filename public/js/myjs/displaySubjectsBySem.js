document.getElementById('semester').addEventListener('change', function() {
    var semester = this.value;
    var gradeLevel = document.getElementById('gradeLevel').value;
    var strand = document.getElementById('strand').value;  // Fetch the strand value

    fetch('/fetch-subjectsbysem?gradeLevel=' + encodeURIComponent(gradeLevel) +
          '&semester=' + encodeURIComponent(semester) +
          '&strand=' + encodeURIComponent(strand))  // Include strand in the request
        .then(response => response.json())
        .then(data => {
            var subjectContainer = document.getElementById('subjectContainer');
            subjectContainer.innerHTML = '';

            var selectedSubjects = [];

            if (data.length > 0) {
                data.forEach(subject => {
                    var subjectDiv = document.createElement('div');
                    var checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'subjects[]';
                    checkbox.value = subject.id;
                    checkbox.checked = true;

                    var label = document.createElement('label');
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(subject.subject));
                    label.classList.add('subject-label');

                    subjectDiv.appendChild(label);
                    subjectContainer.appendChild(subjectDiv);

                    selectedSubjects.push(subject.subject);
                });
            } else {
                subjectContainer.textContent = 'No Subject Found';
            }

            // Set hidden input with selected subjects
            document.getElementById('selectedSubjects').value = selectedSubjects.join(', ');
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
            var subjectContainer = document.getElementById('subjectContainer');
            subjectContainer.textContent = 'Error fetching subjects';
        });
});
