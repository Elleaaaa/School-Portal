<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>

    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('plugins/simple-calendar/simple-calendar.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    <div class="main-wrapper">
        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ $studentName }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Student Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>


                {{-- <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-nine w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{ $subjectCount }}</h3>
                                        <h6><a
                                                href="{{ route('student-subjectlist.show', ['studentId' => Auth::user()->studentId]) }}">Subjects</a>
                                        </h6>
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
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>40/60</h3>
                                        <h6>All Projects</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-ten w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>30/50</h3>
                                        <h6>Test Attended</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-eleven w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>15/20</h3>
                                        <h6>Test Passed</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  --}}

                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Payments</h5>
                                <canvas id="paymentsChart" class="w-100" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendance</h5>
                                <canvas id="attendanceChart" class="w-100" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>                

                {{-- SIMPLE CALENDAR --}}
                {{-- <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">
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
                                    <div id="calendar-doctor" class="calendar-container"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-12">
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

    {{-- <script src="{{ asset('plugins/simple-calendar/jquery.simple-calendar.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/calander.js') }}"></script>
    <script src="{{ asset('js/circle-progress.min.js') }}"></script> --}}

    {{-- FULL CALENDAR --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('js/myjs/eventsviewonly.fullcalender.js') }}"></script>


    {{-- JS CHART --}}
    <script src="{{ asset('js/chart.js') }}"></script>
    {{-- DATA LABELS FOR JS CHART --}}
    <script src="{{ asset('js/chartjs-plugin-datalabels@2.2.0.js') }}"></script>

    {{-- ATTENDANCE GRAPH --}}
    <script src="{{ asset('js/myjs/graph/studentAttendanceGraph.js') }}"></script>
    {{-- PAYMENTS GRAPH --}}
    <script src="{{ asset('js/myjs/graph/studentPaymentGraph.js') }}"></script>


</body>

</html>
