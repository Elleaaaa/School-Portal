<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>

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
                            <h3 class="page-title">Welcome Admin!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
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
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-one w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $enrolledCount }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Students</a></h6>
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
                                        <i class="fas fa-crown"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $teachersCount }}</h3>
                                        <h6><a href="{{ route('teacherlist.show') }}">Teachers</a></h6>
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
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $tuitionTotalPaidCount }}</h3>
                                        <h6>Total Paid</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-four w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $tuitionTotalNotPaidCount }}</h3>
                                        <h6>Not Paid</h6>
                                    </div>
                                </div>
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
                                            <option value="Mandatory">Mandatory</option>
                                            <option value="Voluntary">Voluntary</option>
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
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submitButton">Save
                                        Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-sm-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Payments</h5>
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

        </div>

    </div>
    </div>
    </div>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('js/myjs/events.fullcalendar.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- PAYMENTS GRAPH --}}
    <script src="{{ asset('js/myjs/graph/allPaymentGraph.js') }}"></script>
    <script src="{{ asset('js/myjs/graph/allAttendanceGraph.js') }}"></script>

</body>


</html>
