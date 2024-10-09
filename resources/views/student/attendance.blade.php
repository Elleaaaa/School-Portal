<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Attendance</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">

    <style>
        .attendance-legend {
            margin-top: 10px;
            /* Add some spacing above the legend */
            display: flex;
            /* Use flexbox for layout */
            flex-direction: column;
            /* Stack items vertically */
        }

        .legend-item {
            display: flex;
            /* Flex for box and text alignment */
            align-items: center;
            /* Center vertically */
        }

        .legend-box {
            width: 20px;
            /* Width of the color box */
            height: 20px;
            /* Height of the color box */
            border-radius: 3px;
            /* Optional: rounded corners */
            margin-right: 5px;
            /* Space between box and text */
        }

        .present {
            background-color: green;
            color: #155724;
        }

        .absent {
            background-color: red;
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
                {{-- <div class="container mt-5">
                    <h1 class="mb-4">Attendance Summary for <span id="current-month"></span></h1>
                    <div class="form-group">
                        <label for="month-picker">Select Month:</label>
                        <input type="month" id="month-picker" class="form-control" value="">
                    </div>
                    <div id="attendance-summary">
                        <!-- Attendance records will be displayed here -->
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title">Calendar</h5>
                                        <div class="attendance-legend">
                                            <span class="legend-item">
                                                <span class="legend-box present"></span> Present
                                            </span>
                                            <br />
                                            <span class="legend-item">
                                                <span class="legend-box absent"></span> Absent
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="calendar" class="calendar-container"></div>
                                {{-- <div id="attendance-summary"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('js/myjs/getAttendance.js') }}"></script>
    <script src="{{ asset('js/myjs/attendanceStudentCalendar.js') }}"></script>


</body>

</html>
