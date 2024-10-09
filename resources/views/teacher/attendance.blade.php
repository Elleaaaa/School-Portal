<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $section }} Attendance</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <style>
        .attendance-table {
            margin-top: 20px;
        }

        .attendance-table th,
        .attendance-table td {
            text-align: center;
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
                            <h3 class="page-title">Attendance</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        <table id="attendanceTable" class="table table-bordered attendance-table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Absent</th>
                                    <th class="text-center">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myStudents as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td class="text-center">
                                            <div class="custom-radio">
                                                <input type="radio" name="attendance[{{ $student->studentId }}]" value="1" checked required>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-radio">
                                                <input type="radio" name="attendance[{{ $student->studentId }}]" value="0" required>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <select name="reason[{{ $student->studentId }}]" class="form-control">
                                                <option value="">Select Reason</option>
                                                <option value="Sick">Sick</option>
                                                <option value="Family Emergency">Family Emergency</option>
                                                <option value="Personal Reasons">Personal Reasons</option>
                                                <option value="School Event">School Event</option>
                                                <option value="No Reason">No Reason</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Submit Attendance</button>
                    </form>
                </div>
            </div>
            @include('layouts/footer')
        </div>
    </div>

    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
      
    <script>
        new DataTable('#attendanceTable', {
        lengthMenu: [5, 10, 25, 50, 100, { label: 'All', value: -1 }],
         layout: {
         top1Start: {
         }
     }
     });
     </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the student rows
        const rows = document.querySelectorAll('#attendanceTable tbody tr');
        
        rows.forEach(row => {
            // Get the radio buttons and reason dropdown for the current row
            const presentRadio = row.querySelector('input[type="radio"][value="1"]');
            const absentRadio = row.querySelector('input[type="radio"][value="0"]');
            const reasonSelect = row.querySelector('select[name^="reason"]');
            
            // Function to update the required attribute of the reason dropdown
            function updateReasonRequirement() {
                if (absentRadio.checked) {
                    reasonSelect.required = true;
                } else {
                    reasonSelect.required = false;
                    reasonSelect.value = ""; // Clear value if not required
                }
            }
    
            // Attach event listeners to radio buttons
            presentRadio.addEventListener('change', updateReasonRequirement);
            absentRadio.addEventListener('change', updateReasonRequirement);
            
            // Initial check in case a radio button is pre-selected
            updateReasonRequirement();
        });
    });
    </script>
    

</body>

</html>
