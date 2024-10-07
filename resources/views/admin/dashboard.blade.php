<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">

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

        .db-info h3 {
            text-align: right;
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

                {{-- @if (session('success'))
                    <div id="successAlert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failed'))
                    <div id="failedAlert" class="alert alert-failed">
                        {{ session('failed') }}
                    </div>
                @endif --}}

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
                                        <h6><a href="{{ route('studentlist.show') }}">Enrolled Students</a></h6>
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
                                        <i class="fas fa-chalkboard-teacher"></i>
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
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $pendingCount }}</h3>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade7 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 7 Students</a></h6>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade8 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 8 Students</a></h6>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade9 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 9 Students</a></h6>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade10 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 10 Students</a></h6>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade11 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 11 Students</a></h6>
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
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $grade12 }}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Grade 12 Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title">Student Graph</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="studentGraph"></canvas> <!-- Changed to canvas for Chart.js -->
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
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
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
    {{-- TIMER FOR ALERTS --}}
    <script src="{{ asset('js/myjs/timerAlert.js') }}"></script>

    <script src="{{ asset('js/myjs/events.fullcalendar.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    <script>
        // Fetch the Laravel data passed from the controller
        var grade7 = @json($grade7);
        var grade8 = @json($grade8);
        var grade9 = @json($grade9);
        var grade10 = @json($grade10);
        var grade11 = @json($grade11);
        var grade12 = @json($grade12);

        var ctx = document.getElementById('studentGraph').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Specify the chart type
            data: {
                labels: ['Grade Level'], // Use one common label for all grades
                datasets: [{
                        label: 'Grade 7',
                        data: [grade7],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Grade 8',
                        data: [grade8],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Grade 9',
                        data: [grade9],
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Grade 10',
                        data: [grade10],
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Grade 11',
                        data: [grade11],
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Grade 12',
                        data: [grade12],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Ensures that the y-axis starts from 0
                    }
                },
                plugins: {
                    legend: {
                        display: true, // Display a legend with each grade
                        onClick: function(e, legendItem) {
                            const index = legendItem.datasetIndex;
                            const ci = this.chart;
                            const meta = ci.getDatasetMeta(index);

                            // Toggle visibility of the clicked dataset
                            meta.hidden = meta.hidden === null ? !ci.data.datasets[index].hidden : null;
                            ci.update();
                        }
                    }
                }
            }
        });
    </script>



    {{-- Incase above code not working well, this code will display enrolled students also grade 7-12 --}}
    {{-- <script>
    // Fetch the Laravel data passed from the controller
    var grade7 = @json($grade7);
    var grade8 = @json($grade8);
    var grade9 = @json($grade9);
    var grade10 = @json($grade10);
    var grade11 = @json($grade11);
    var grade12 = @json($grade12);

    var ctx = document.getElementById('studentGraph').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar', // Specify the chart type
        data: {
            labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'],
            datasets: [{
                label: 'Number of Enrolled Students',
                data: [grade7, grade8, grade9, grade10, grade11, grade12],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Ensures that the y-axis starts from 0
                }
            }
        }
    });
</script> --}}



</body>


</html>
