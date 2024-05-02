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

                @if (session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('failed'))
                    <div id="failedAlert" class="alert alert-failed">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('enroll-student.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Enrollment Form</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                       
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middleName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input type="text" class="form-control" name="suffixName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel" required>
                                                    <option value=""></option>
                                                    <option value="Grade 7">Grade 7</option>
                                                    <option value="Grade 8">Grade 8</option>
                                                    <option value="Grade 9">Grade 9</option>
                                                    <option value="Grade 10">Grade 10</option>
                                                    <option value="Grade 11">Grade 11</option>
                                                    <option value="Grade 12">Grade 12</option>
                                                </select>
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
                                                <select class="form-control" name="semester">
                                                    <option></option>
                                                    <option value="First Semester">First Semester</option>
                                                    <option value="Second Semester">Second Semester</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                               {{-- section will be display here --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="classType">Class Type</label>
                                                <select class="form-control" name="classType">
                                                    <option value=""></option>
                                                    <option value="Regular Class">Regular Class</option>
                                                    <option value="Special Science Class">Special Science Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="Enrolled">Enrolled</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Enroll Student</button>
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

    {{-- DISPLAY SECTION DEPENDS ON GRADE LEVEL --}}
    <script>
        // Add event listener to grade level select dropdown
        document.getElementById('gradeLevel').addEventListener('change', function() {
            var gradeLevel = this.value;
            
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
                })
                .catch(error => {
                    console.error('Error fetching sections:', error);
                });
        });
    </script>



    {{-- DISPLAY SUBJECTS DEPENDS ON GRADE LEVEL --}}
    <script>
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
    </script>

    {{-- TIMER FOR ALERTS --}}
    <script>
        function hideAlerts() {
            setTimeout(function() {
                var successAlert = document.getElementById('successAlert');
                var failedAlert = document.getElementById('failedAlert');

                if (successAlert) {
                    successAlert.style.display = 'none';
                }
                if (failedAlert) {
                    failedAlert.style.display = 'none';
                }
            }, 5000); // Adjust the time here (in milliseconds)
        }

        // Call the timer function when the page loads
        window.onload = function() {
            hideAlerts();
        };
    </script>

    {{-- Auto populate student details when student ID is entered --}}
    <script>
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
                xhr.open('POST', '/fetch-student-details', true);
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
                                document.querySelector('input[name="firstName"]').value = studentDetails.firstName;
                                document.querySelector('input[name="middleName"]').value = studentDetails.middleName;
                                document.querySelector('input[name="lastName"]').value = studentDetails.lastName;
                                document.querySelector('input[name="suffixName"]').value = studentDetails.suffix;
                            } else {
                                // Display a message if no student is found
                                alert('No student found with the provided ID');
                                // Clear the fields if no student is found
                                document.querySelector('input[name="firstName"]').value = '';
                                document.querySelector('input[name="middleName"]').value = '';
                                document.querySelector('input[name="lastName"]').value = '';
                                document.querySelector('input[name="suffixName"]').value = '';
                            }
                        } else if (xhr.status === 404) {
                            // Handle the case where the student is not found
                            alert('No student found with the provided ID');
                            // Clear the fields if no student is found
                            document.querySelector('input[name="firstName"]').value = '';
                            document.querySelector('input[name="middleName"]').value = '';
                            document.querySelector('input[name="lastName"]').value = '';
                            document.querySelector('input[name="suffixName"]').value = '';
                        } else {
                            console.error('Error fetching student data');
                        }
                    }
                };
                xhr.send(JSON.stringify({ studentId: studentId }));
            }
        });
    </script>
</body>

</html>
