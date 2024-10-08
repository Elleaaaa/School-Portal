<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Teacher Dashboard</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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
                            <h3 class="page-title">Welcome {{ $teacher->firstName }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><strong>Dashboard</strong></li>
                                <li class="breadcrumb-item active">Teacher Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-five w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-chalkboard"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $handleSections }}</h3>
                                        <h6>Total Classes</h6>
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
                                    <div class="db-info">
                                        <h3>{{ $studentTotalCount }}</h3>
                                        <h6>Total Students</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($sections as $section)
                        <div class="col-xl-3 col-sm-6 col-12 d-flex">
                            <div class="card bg-six w-100">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="db-info">
                                            <h3>{{ $section->studentCount }}</h3>
                                            <h6>{{ $section->gradeLevel }} - {{ $section->section }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <!-- Present Card -->
                    <div class="col-xl-6 col-md-6 col-sm-12 d-flex">
                        <div class="card bg-success w-100"> <!-- Green color for Present -->
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <!-- Icon for Present (Check) -->
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
                        <div class="card bg-danger w-100"> <!-- Red color for Absent -->
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <!-- Icon for Absent (User with X) -->
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
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Genders</h5>
                                <canvas id="genderChart" class="w-100" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Students by Grade Level</h5>
                                <canvas id="gradeLevelChart" class="w-100" height="100"></canvas>
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

            </div>

            @include('layouts/footer')

        </div>

    </div>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('js/myjs/eventsviewonly.fullcalender.js') }}"></script>
    {{-- JS CHART --}}
    <script src="{{ asset('js/chart.js') }}"></script>
    {{-- DATA LABELS FOR JS CHART --}}
    <script src="{{ asset('js/chartjs-plugin-datalabels@2.2.0.js') }}"></script>

    {{-- GENDER CHART --}}
    <script src="{{ asset('js/myjs/graph/genderGraph.js') }}"></script>

    {{-- GRADE LEVEL CHART --}}
    <script src="{{ asset('js/myjs/graph/gradeLevelGraph.js') }}"></script>





</body>

</html>
