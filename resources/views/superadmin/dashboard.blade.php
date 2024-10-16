<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">

    <style>
        .calendar-container {
            overflow-x: auto;
            /* Enables horizontal scrolling */
            overflow-y: hidden;
            /* Prevents vertical scrolling */
        }

        @media (max-width: 768px) {
            .calendar-container {
                display: block;
                /* Ensures the container takes up the full width */
            }

            /* Ensure the entire FullCalendar, including the header, is scrollable */
            .fc-view,
            .fc-toolbar {
                min-width: 600px;
                white-space: nowrap;
                /* Prevents wrapping */
            }
        }
    </style>

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome superadmin</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-three w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $pendingCount }}</h3>
                                        <h6>Pending Enrollment</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-one w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $teachersCount }}</h3>
                                        <h6><a href="{{ route('teacherlist.show') }}">Teachers</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-two w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $tuitionTotalPaidCount }}</h3>
                                        <h6>Total Paid</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-three w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $tuitionTotalNotPaidCount }}</h3>
                                        <h6>Not Paid</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $enrolledCount }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Enrolled Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade7 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 7 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade8 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 8 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade9 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 9 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade10 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 10 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade11 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 11 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-six w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info d-flex flex-column align-items-end">
                                        <h3 class="mb-0">{{ $grade12 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 12 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Present Card -->
                    <div class="col-xl-6 col-md-6 col-sm-12 d-flex">
                        <div class="card bg-success w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $presentToday }}</h3>
                                        <h6>Present Today</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Absent Card -->
                    <div class="col-xl-6 col-md-6 col-sm-12 d-flex">
                        <div class="card bg-danger w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $absentToday }}</h3>
                                        <h6>Absent Today</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-sm-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tuition Fee Collected</h5>
                                <canvas id="paymentsChart" class="w-100" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-sm-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendance</h5>
                                <canvas id="attendanceChart" class="w-100" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Absent Report</h5>
                            <label for="dateFilter">Filter by date:</label>
                            <select id="dateFilter" class="form-control mb-3">
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last7days">Last 7 Days</option>
                            </select>
                            <canvas id="absentChart" class="w-100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            
                <div class="col-12 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grade Levels</h5>
                            <label for="dateFilter" style="color: white; opacity: 0; pointer-events: none;">Filter by date:</label>
                            <select id="dateFilter" class="form-control mb-3" style="color: white; opacity: 0; pointer-events: none;">
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last7days">Last 7 Days</option>
                            </select>
                            <canvas id="gradeLevelChart" class="w-100" height="200"></canvas>
                        </div>
                    </div>
                </div>
                                                
            </div>
            

            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Calendar</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="calendar" class="calendar-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts/footer')

            <!-- Modal for adding new event -->
            <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog"
                aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="eventForm" method="POST" action="{{ route('events.store') }}"
                            onsubmit="return validateDateTime()">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="eventName">Event Name</label>
                                    <input type="text" class="form-control" id="eventName" name="eventName"
                                        placeholder="Enter Event Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="Faculty">Faculty</option>
                                        <option value="General">General</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_datetime">Start Date and Time</label>
                                    <input type="datetime-local" class="form-control" id="start_datetime"
                                        name="start_datetime" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_datetime">End Date and Time</label>
                                    <input type="datetime-local" class="form-control" id="end_datetime"
                                        name="end_datetime" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitButton">Save
                                    Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>
    </div>
    </div>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('js/myjs/events.fullcalendar.js') }}"></script>


    {{-- JS CHART --}}
    <script src="{{ asset('js/chart.js') }}"></script>
    {{-- DATA LABELS FOR JS CHART --}}
    <script src="{{ asset('js/chartjs-plugin-datalabels@2.2.0.js') }}"></script>

    {{-- PAYMENTS GRAPH --}}
    <script src="{{ asset('js/myjs/graph/allPaymentGraph.js') }}"></script>
    {{-- ATTENDANCE GRAPH --}}
    <script src="{{ asset('js/myjs/graph/allAttendanceGraph.js') }}"></script>
    {{-- ABSENT GRAPH --}}
    <script src="{{ asset('js/myjs/graph/absentReport.js') }}"></script>
     {{-- GRADE LEVEL GRAPH --}}
     <script src="{{ asset('js/myjs/graph/gradeLevelChart.js') }}"></script>

   
    
    


</body>


</html>
