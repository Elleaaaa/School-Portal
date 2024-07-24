<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <style>
        .present {
            background-color: #d4edda;
            color: #155724;
        }

        .absent {
            background-color: #f8d7da;
            color: #721c24;
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
                <div class="container mt-5">
                    <h1 class="mb-4">Attendance Summary for <span id="current-month"></span></h1>
                    <div class="form-group">
                        <label for="month-picker">Select Month:</label>
                        <input type="month" id="month-picker" class="form-control" value="">
                    </div>
                    <div id="attendance-summary">
                        <!-- Attendance records will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

   <script src="{{ asset('js/myjs/getAttendance.js') }}"></script>

</body>

</html>
