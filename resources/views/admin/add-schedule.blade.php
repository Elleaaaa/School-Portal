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
                            <h3 class="page-title">Add Schedule</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Sections</a></li>
                                <li class="breadcrumb-item active">Add Schedule</li>
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
                                <form method="POST" action="{{ route('add-timetable.store') }}">
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
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="teacher">Teacher Name</label>
                                                <select name="teacher" id="teacher" class="form-control">
                                                    <option value="" selected disabled>Select Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->teacherId }}">{{ $teacher->firstName . ' ' . $teacher->lastName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subject">Subject</label>
                                                <select id="subject" name="subject" class="form-control">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="day">Day</label>
                                                <select class="form-control" id="day" name="day" required>
                                                    <option value=""></option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                    <option value="Sunday">Sunday</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="room">Room</label>
                                                <input class="form-control"  type="text" id="room" name="room">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="start_time">Start Time:</label>
                                                <input class="form-control"  type="text" id="start_time" name="start_time">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="end_time">End Time:</label>
                                                <input class="form-control" type="text" id="end_time" name="end_time">
                                            </div>
                                        </div>
                                        

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Add</button>
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

    <script>
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
    </script>

<script>
    // JavaScript code to fetch subjects based on selected grade level
    document.getElementById('gradeLevel').addEventListener('change', function() {
        var gradeLevel = this.value;
        var subjectSelect = document.getElementById('subject');
        
        // Clear existing options
        subjectSelect.innerHTML = '<option value="">Loading...</option>';
        
        // Fetch subjects based on selected grade level
        fetch('/fetch-subjects?gradeLevel=' + encodeURIComponent(gradeLevel))
            .then(response => response.json())
            .then(subjects => {
                // Populate subject options
                subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                subjects.forEach(subject => {
                    var option = document.createElement('option');
                    option.value = subject.subjectTitle;
                    option.text = subject.subjectTitle;
                    subjectSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching subjects:', error);
                subjectSelect.innerHTML = '<option value="">No Subject Available</option>';
            });
    });
</script>


</body>

</html>
