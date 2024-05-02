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
                            <h3 class="page-title">Add Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                                <li class="breadcrumb-item active">Add Subject</li>
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
                                <form method="POST" action="{{ route('subject.add') }}">
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
                                                <label>Subject Code</label>
                                                <input name="subjectCode" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Subject Title</label>
                                                <input name="subjectTitle" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectType">Subject Type</label>
                                                <select class="form-control" id="subjectType" name="subjectType">
                                                    <option value=""></option>
                                                    <option value="Major Subject">Major Subject</option>
                                                    <option value="Minor Subject">Minor Subject</option>
                                                    <option value="General Subject">General Subject</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectTeacher">Subject Teacher</label>
                                                <select name="subjectTeacher" id="subjectTeacher" class="form-control">
                                                    <option value="" selected disabled>Select Subject Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->firstName . ' ' . $teacher->lastName }}">{{ $teacher->firstName . ' ' . $teacher->lastName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label hidden>Teacher ID</label>
                                                <input name="teacherId" id="teacherId" type="text" class="form-control" readonly hidden>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Lecture Unit</label>
                                                <input name="lectureUnit" id="lectureUnit" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Laboratory Unit</label>
                                                <input name="labUnit" id="labUnit" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Units</label>
                                                <input readonly name="totalUnits" id="totalUnits" type="number" class="form-control">
                                            </div>
                                        </div> --}}
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



    {{-- Getting the total Units --}}
    {{-- <script>
        // Get references to the input fields
        const lectureUnitInput = document.getElementById('lectureUnit');
        const labUnitInput = document.getElementById('labUnit');
        const totalUnitsInput = document.getElementById('totalUnits');
    
        // Function to calculate the total units
        function calculateTotalUnits() {
            const lectureUnit = parseInt(lectureUnitInput.value) || 0;
            const labUnit = parseInt(labUnitInput.value) || 0;
            const totalUnits = lectureUnit + labUnit;
            totalUnitsInput.value = totalUnits; //.toFixed(2) Display the total units with 2 decimal places
        }
    
        // Calculate the total units when the lecture or lab unit inputs change
        lectureUnitInput.addEventListener('input', calculateTotalUnits);
        labUnitInput.addEventListener('input', calculateTotalUnits);
    </script> --}}

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
        var teachers = @json($teachers);
        document.getElementById('subjectTeacher').addEventListener('change', function() {
            var selectedTeacherId = this.value;
            var teacherIdInput = document.getElementById('teacherId');
            
            // Loop through the teachers array to find the selected teacher
            for (var i = 0; i < teachers.length; i++) {
                if (teachers[i].teacherId === selectedTeacherId) {
                    teacherIdInput.value = teachers[i].teacherId;
                    break; // Exit the loop once the teacher is found
                }
            }
        });
    </script>

</body>

</html>
