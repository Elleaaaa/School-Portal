<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Subject</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body>

    <div class="main-wrapper">

        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                                <li class="breadcrumb-item active">Edit Subject</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('edit-subject.update', ['id' => $subject->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Subject Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectType">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel">
                                                    <option value=""></option>
                                                    <option value="Grade 7" {{ $subject->gradeLevel === 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                                    <option value="Grade 8" {{ $subject->gradeLevel === 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                                    <option value="Grade 9" {{ $subject->gradeLevel === 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                                    <option value="Grade 10" {{ $subject->gradeLevel === 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                                    <option value="Grade 11" {{ $subject->gradeLevel === 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                                    <option value="Grade 12" {{ $subject->gradeLevel === 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                                    <option value=""></option>
                                                    @foreach($sections as $section)
                                                        <option value="{{ $section }}" {{ $subject->section === $section ? 'selected' : '' }}>{{ $section }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Subject Title</label>
                                                <input name="subjectTitle" type="text" class="form-control" value="{{$subject->subjectTitle}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectType">Subject Type</label>
                                                <select class="form-control" id="subjectType" name="subjectType">
                                                    <option value=""></option>
                                                    <option value="Major Subject" {{ $subject->subjectType === 'Major Subject' ? 'selected' : '' }}>Major Subject</option>
                                                    <option value="Minor Subject" {{ $subject->subjectType === 'Minor Subject' ? 'selected' : '' }}>Minor Subject</option>
                                                    <option value="General Subject" {{ $subject->subjectType === 'General Subject' ? 'selected' : '' }}>General Subject</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectTeacher">Subject Teacher</label>
                                                <select class="form-control" id="subjectTeacher" name="subjectTeacher">
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->firstName . ' ' . $teacher->lastName }}" {{ $subject->subjectTeacher === ($teacher->firstName . ' ' . $teacher->lastName) ? 'selected' : '' }}>
                                                            {{ $teacher->firstName . ' ' . $teacher->lastName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label hidden>Teacher ID</label>
                                                <input name="teacherId" id="teacherId" type="text" class="form-control" readonly >
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var teachers = @json($teachers);
        var subjectTeacherSelect = document.getElementById('subjectTeacher');
        var teacherIdInput = document.getElementById('teacherId');

        // Function to populate teacher ID based on selected teacher
        function populateTeacherId() {
            var selectedTeacherName = subjectTeacherSelect.value;
            for (var i = 0; i < teachers.length; i++) {
                if (teachers[i].firstName + ' ' + teachers[i].lastName === selectedTeacherName) {
                    teacherIdInput.value = teachers[i].teacherId;
                    break;
                }
            }
        }

        // Populate teacher ID when page loads
        populateTeacherId();

        // Update teacher ID when subject teacher selection changes
        subjectTeacherSelect.addEventListener('change', function() {
            populateTeacherId();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var gradeLevelSelect = document.getElementById('gradeLevel');
        var sectionSelect = document.getElementById('section');

        // Function to fetch and populate sections
        function fetchSections(gradeLevel, selectedSection = null) {
            sectionSelect.innerHTML = '<option value="">Loading...</option>';
            fetch('/fetch-sections?gradeLevel=' + encodeURIComponent(gradeLevel))
                .then(response => response.json())
                .then(sections => {
                    sectionSelect.innerHTML = '<option value="">Select Section</option>';
                    sections.forEach(section => {
                        var option = document.createElement('option');
                        option.value = section.sectionName;
                        option.text = section.sectionName;
                        if (selectedSection && selectedSection === section.sectionName) {
                            option.selected = true;
                        }
                        sectionSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching sections:', error);
                    sectionSelect.innerHTML = '<option value="">No Section Available</option>';
                });
        }

        // Fetch sections when grade level changes
        gradeLevelSelect.addEventListener('change', function() {
            fetchSections(this.value);
        });

        // Pre-populate sections if editing a subject
        @if(isset($subject))
            fetchSections('{{ $subject->gradeLevel }}', '{{ $subject->section }}');
        @endif
    });
</script>




</body>

</html>
