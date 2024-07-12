<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Enroll Student</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        input[type="checkbox"] {
        transform: scale(1.5);
        margin-right: 10px;
        margin-left: 20px;
    }
    </style>
</head>

<body>

    <div class="main-wrapper">

        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Enroll Student</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Enroll</a></li>
                                <li class="breadcrumb-item active">Enroll Student</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('selfEnroll.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Enrollment Form</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId" required readonly value="{{ $student->studentId ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                       
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName" readonly value="{{ $student->firstName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middleName" readonly value="{{ $student->middleName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName" readonly value="{{ $student->lastName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input type="text" class="form-control" name="suffixName" readonly value="{{ $student->suffix ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <input type="text" class="form-control" name="gradeLevel" id="gradeLevel" readonly value="{{ $gradeLevelUp ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group" id="subjectContainer">
                                                <!-- Subjects will be dynamically added here -->
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" id="selectedSubjects" name="subjects" hidden>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <input type="text" class="form-control" name="semester" readonly value="{{ $enrollee->semester ?? '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                                    {{-- section will be displayed here --}}
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="classType">Class Type</label>
                                                <input type="text" class="form-control" name="classType" readonly value="{{ $enrollee->classType ?? '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-4" hidden>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control" name="status" value="Pending">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts/footer')

    {{-- DISPLAY SUBJECTS DEPENDS ON GRADE LEVEL ON SELF ENROLL --}}
    <script>
        // Function to fetch and display subjects based on the grade level
        function fetchAndDisplaySubjects(gradeLevel) {
            console.log('Fetching subjects for grade level:', gradeLevel);

            // Make AJAX request to fetch subjects based on grade level
            fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel))
                .then(response => response.json())
                .then(data => {
                    console.log('Subjects data received:', data);

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
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Fetch and display subjects when the page loads
            var initialGradeLevel = document.getElementById('gradeLevel').value;
            fetchAndDisplaySubjects(initialGradeLevel);

            // Add event listener to grade level dropdown
            document.getElementById('gradeLevel').addEventListener('change', function() {
                var gradeLevel = this.value;
                fetchAndDisplaySubjects(gradeLevel);
            });
        });
    </script>

    {{-- DISPLAY SECTION DEPENDS ON GRADE LEVEL --}}
    <script>
        // Function to fetch sections based on grade level
        function fetchSections() {
            var gradeLevel = document.getElementById('gradeLevel').value;
            
            // Make AJAX request to fetch sections based on grade level
            fetch('/fetch-sections?gradeLevel=' + encodeURIComponent(gradeLevel))
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    var sectionSelect = document.getElementById('section');
                    sectionSelect.innerHTML = '<option value=""></option>';
                    
                    // Check if sections are found
                    if (data.length > 0) {
                        // Populate the section select dropdown with fetched sections
                        data.forEach(section => {
                            var option = document.createElement('option');
                            option.value = section.sectionName;
                            option.text = section.sectionName;
                            sectionSelect.appendChild(option);
                        });
                    } else {
                        // Display "No Section Found" if no sections are found
                        var option = document.createElement('option');
                        option.text = 'No Section Found';
                        sectionSelect.appendChild(option);
                    }
    
                    // Set the selected section value from database
                    var sectionValue = "{{ $enrollee->section }}";
                    sectionSelect.value = sectionValue;
                })
                .catch(error => {
                    console.error('Error fetching sections:', error);
                });
        }
        
        // Call fetchSections function when the page loads
        window.onload = function() {
            fetchSections(); // Fetch sections immediately after page loads
        };
    
        // Call fetchSections function after setting the grade level value programmatically
        var gradeLevelValue = "{{ $gradeLevelUp }}"; // Assuming this fetches the grade level from the database
        document.getElementById('gradeLevel').value = gradeLevelValue; // Set the grade level value
        fetchSections(); // Fetch sections based on the grade level value
    </script>


</body>

</html>
