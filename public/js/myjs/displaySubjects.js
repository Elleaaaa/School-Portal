document.getElementById('section').addEventListener('change', function() {
    var section = this.value;
    var gradeLevel = document.getElementById('gradeLevel').value;

    fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel) + '&section=' + encodeURIComponent(section))
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

            document.getElementById('selectedSubjects').value = selectedSubjects.join(', ');
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
        });
});
