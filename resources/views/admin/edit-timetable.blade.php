<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Subject</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>

    <div class="main-wrapper">

        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Schedule</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Schedule</a></li>
                                <li class="breadcrumb-item active">Edit Schedule</li>
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
                                <form method="POST" action="{{ route('edit-timetable.update', ['id' => $lesson->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Schedule</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel" required>
                                                    <option value=""></option>
                                                    <option value="Grade 7" {{ $lesson->gradeLevel === 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                                    <option value="Grade 8" {{ $lesson->gradeLevel === 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                                    <option value="Grade 9" {{ $lesson->gradeLevel === 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                                    <option value="Grade 10" {{ $lesson->gradeLevel === 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                                    <option value="Grade 11" {{ $lesson->gradeLevel === 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                                    <option value="Grade 12" {{ $lesson->gradeLevel === 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                                    <option value=""></option>
                                                    @foreach($sections as $section)
                                                        <option value="{{ $section }}" {{ $lesson->section === $section ? 'selected' : '' }}>{{ $section }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="teacher">Teacher</label>
                                                <select name="teacher" id="teacher" class="form-control" required>
                                                    <option value="">Select Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->teacherId }}" {{ $teacher->teacherId === $lesson->teacherId ? 'selected' : '' }}>
                                                            {{ $teacher->firstName }} {{ $teacher->lastName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subject">Subject</label>
                                                <select name="subject" id="subject" class="form-control" required>
                                                    <option value=""></option>
                                                        @foreach($subjects as $subject)
                                                            <option value="{{ $subject }}" {{ $lesson->subject === $subject ? 'selected' : '' }}>{{ $subject }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="day">Day</label>
                                                <select class="form-control" id="day" name="day" required>
                                                    <option value=""></option>
                                                    <option value="Monday" {{ $lesson->day === 'Monday' ? 'selected' : '' }}>Monday</option>
                                                    <option value="Tuesday" {{ $lesson->day === 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                    <option value="Wednesday" {{ $lesson->day === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                    <option value="Thursday" {{ $lesson->day === 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                                    <option value="Friday" {{ $lesson->day === 'Friday' ? 'selected' : '' }}>Friday</option>
                                                    <option value="Saturday" {{ $lesson->day === 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                                    <option value="Sunday" {{ $lesson->day === 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="room">Room</label>
                                                <input class="form-control" type="text" id="room" name="room" value="{{ $lesson->room ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="start_time">Start Time:</label>
                                                <input class="form-control" type="text" id="start_time" name="start_time" value="{{ $lesson->start_time ?? '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="end_time">End Time:</label>
                                                <input class="form-control" type="text" id="end_time" name="end_time" value="{{ $lesson->end_time ?? '' }}">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
      
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>

       <script>
        flatpickr("#end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>

    

   {{-- TIMER FOR ALERTS --}}
   <script src="{{ asset('js/myjs/timerAlert.js') }}"></script>

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

        // Pre-populate sections if editing a lesson
        @if(isset($lesson))
            fetchSections('{{ $lesson->gradeLevel }}', '{{ $lesson->sectionId }}');
        @endif
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var gradeLevelSelect = document.getElementById('gradeLevel');
        var subjectSelect = document.getElementById('subject');

        // Function to fetch and populate subjects
        function fetchSubjects(gradeLevel, selectedSubject = null) {
            subjectSelect.innerHTML = '<option value="">Loading...</option>';
            fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel))
                .then(response => response.json())
                .then(subjects => {
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                    subjects.forEach(subject => {
                        var option = document.createElement('option');
                        option.value = subject.subjectTitle;
                        option.text = subject.subjectTitle;
                        if (selectedSubject && selectedSubject === subject.subjectTitle) {
                            option.selected = true;
                        }
                        subjectSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                    subjectSelect.innerHTML = '<option value="">No Subject Available</option>';
                });
        }

        // Fetch subjects when grade level changes
        gradeLevelSelect.addEventListener('change', function() {
            fetchSubjects(this.value);
        });

        // Pre-populate subjects if editing a lesson
        @if(isset($lesson))
            fetchSubjects('{{ $lesson->gradeLevel }}', '{{ $lesson->subjectId }}');
        @endif
    });
</script>


</body>

</html>
