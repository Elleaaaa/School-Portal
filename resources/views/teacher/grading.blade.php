<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>All Students</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div>

                    <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="gradeImport">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="gradeTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-left" hidden>ID</th>
                                                <th class="text-left">Student ID</th>
                                                <th>Name</th>
                                                <th>Subject</th>
                                                <th>1st Quarter Grade</th>
                                                <th>2nd Quarter Grade</th>
                                                <th>3rd Quarter Grade</th>
                                                <th>4th Quarter Grade</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                @foreach ($studentGrade->where('studentId', $student->studentId) as $grade)
                                                    <tr>
                                                        <td class="text-left" hidden>
                                                            {{ $grade->id }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $student->studentId }}
                                                        </td>
                                                        <td>
                                                            @foreach ($images->where('studentId', $student->studentId) as $image)
                                                                <h2 class="table-avatar">
                                                                    <a href="teacher-details.html" class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ asset('storage/images/display-photo/' . $image->displayPhoto) }}"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="teacher-details.html">{{ $student->firstName }} {{ $student->lastName }}</a>
                                                                </h2>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $grade->subject }}</td>
                                                        <form method="POST" action="{{ route('studentsgrade.update', ['id' => $grade->id]) }}">
                                                            @csrf
                                                            <td>
                                                                {{ $grade->firstQGrade }}
                                                                <input type="number" id="update_firstQGrade" name="firstQGrade" style="width: 80px" hidden>
                                                            </td>
                                                            <td>
                                                                {{ $grade->secondQGrade }}
                                                                <input type="number" id="update_secondQGrade" name="secondQGrade" style="width: 80px" hidden>
                                                            </td>
                                                            <td>
                                                                {{ $grade->thirdQGrade }}
                                                                <input type="number" id="update_thirdQGrade" name="thirdQGrade" style="width: 80px" hidden>
                                                            </td>
                                                            <td>
                                                                {{ $grade->fourthQGrade }}
                                                                <input type="number" id="update_fourthQGrade" name="fourthQGrade" style="width: 80px" hidden>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="actions">
                                                                    <button type="submit" class="btn btn-sm bg-success-light mr-2" id="updateBtn" hidden>Update</button>
                                                                    <button type="button" class="btn btn-sm bg-warning mr-2" id="editBtn">Edit</button>
                                                                </div>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts/footer')
        </div>
    </div>

    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>

    <script>
       new DataTable('#gradeTable', {
        layout: {
        top1Start: {
            buttons: [
                {
                    extend: 'print',
                    split: ['pdf', 'excel', 'csv', 'copy'],
                }
            ]
        }
    }
    });
    </script>
    

    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Get all the edit buttons
            var editButtons = document.querySelectorAll('#editBtn');

            // Add click event listener to each edit button
            editButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    // Get the parent row of the clicked button
                    var parentRow = event.target.closest('tr');

                    // Select the input fields and update button in the row by their IDs
                    var firstQGradeInput = parentRow.querySelector('#update_firstQGrade');
                    var secondQGradeInput = parentRow.querySelector('#update_secondQGrade');
                    var thirdQGradeInput = parentRow.querySelector('#update_thirdQGrade');
                    var fourthQGradeInput = parentRow.querySelector('#update_fourthQGrade');
                    var updateBtn = parentRow.querySelector('#updateBtn');

                    // Toggle the visibility of the input fields and update button
                    firstQGradeInput.hidden = !firstQGradeInput.hidden;
                    secondQGradeInput.hidden = !secondQGradeInput.hidden;
                    thirdQGradeInput.hidden = !thirdQGradeInput.hidden;
                    fourthQGradeInput.hidden = !fourthQGradeInput.hidden;
                    updateBtn.hidden = !updateBtn.hidden;
                });
            });
        });
    </script>

</body>

</html>
