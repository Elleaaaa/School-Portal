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
                                <form method="POST" action="{{ route('edit-enroll-student.update', ['id' => $enrollees->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Enrollment Form</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId" required readonly value="{{ $enrollees->studentId }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                       
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName" readonly value="{{ $firstName }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middleName" readonly value="{{ $middleName }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName" readonly value="{{ $lastName }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input type="text" class="form-control" name="suffixName" readonly value="{{ $suffixName }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel" required > 
                                                    <option value=""></option>
                                                    <option value="Grade 7" {{ $enrollees->gradeLevel == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                                    <option value="Grade 8" {{ $enrollees->gradeLevel == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                                    <option value="Grade 9" {{ $enrollees->gradeLevel == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                                    <option value="Grade 10" {{ $enrollees->gradeLevel == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                                    <option value="Grade 11" {{ $enrollees->gradeLevel == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                                    <option value="Grade 12" {{ $enrollees->gradeLevel == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
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
                                                <input class="form-control" id="selectedSubjects" name="subjects" value="{{ $enrollees->subjects }}" hidden>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select class="form-control" name="semester">
                                                    <option></option>
                                                    <option value="First Semester" {{ $enrollees->semester == 'First Semester' ? 'selected' : '' }}>First Semester</option>
                                                    <option value="Second Semester" {{ $enrollees->semester == 'Second Semester' ? 'selected' : '' }}>Second Semester</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="strand">Strand</label>
                                                <select class="form-control" name="strand">
                                                    <option></option>
                                                    <option value="STEM" {{ $enrollees->strand == 'STEM' ? 'selected' : '' }}>STEM</option>
                                                    <option value="HUMSS" {{ $enrollees->strand == 'HUMSS' ? 'selected' : '' }}>HUMSS</option>
                                                    <option value="ABM" {{ $enrollees->strand == 'ABM' ? 'selected' : '' }}>ABM</option>
                                                </select>
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
                                                <select class="form-control" name="classType">
                                                    <option></option>
                                                    <option value="Regular Class" {{ $enrollees->classType == 'Regular Class' ? 'selected' : '' }}>Regular Class</option>
                                                    <option value="Special Science Class" {{ $enrollees->classType == 'Special Science Class' ? 'selected' : '' }}>Special Science Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="Enrolled" {{ $enrollees->status == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                                                    <option value="Pending" {{ $enrollees->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- DISPLAY SUBJECTS DEPENDS ON GRADE LEVEL --}}
    <script src="{{ asset('js/myjs/displaySubjects.js') }}"></script>

    {{-- Auto populate student details when student ID is entered --}}
    {{-- <script src="{{ asset('js/myjs/populateStudentDetails.js') }}"></script> --}}

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
                    var sectionValue = "{{ $enrollees->section }}";
                    sectionSelect.value = sectionValue;
                })
                .catch(error => {
                    console.error('Error fetching sections:', error);
                });
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            // Call fetchSections function after setting the grade level value programmatically
            var gradeLevelValue = "{{ $enrollees->gradeLevel }}"; // Assuming this fetches the grade level from the database
            var gradeLevelSelect = document.getElementById('gradeLevel');
            
            gradeLevelSelect.value = gradeLevelValue; // Set the grade level value
            fetchSections(); // Fetch sections based on the grade level value
    
            // Add event listener to grade level dropdown
            gradeLevelSelect.addEventListener('change', fetchSections);
        });
    </script>

</body>

</html>
