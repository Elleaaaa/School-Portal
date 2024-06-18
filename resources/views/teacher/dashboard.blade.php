<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Teacher Dashboard</title>

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/simple-calendar/simple-calendar.css') }}">
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
                            <h3 class="page-title">Welcome {{ $teacher->firstName }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
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
                                        <h3>04/06</h3>
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
                                        <h3>40/60</h3>
                                        <h6>Total Students</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-seven w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>30/50</h3>
                                        <h6>Total Lessons</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-eight w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>15/20</h3>
                                        <h6>Total Hours</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">
                        {{-- <div class="row">
                            <div class="col-12 col-lg-8 col-xl-8 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="card-title">Upcoming Lesson</h5>
                                            </div>
                                            <div class="col-6">
                                                <span class="float-right view-link"><a href="#">View All
                                                        Courses</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-3 pb-3">
                                        <div class="table-responsive lesson">
                                            <table class="table table-center">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="date">
                                                                <b>Aug 4, Tuesday</b>
                                                                <p>2.30pm - 3.30pm (60min)</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="date">
                                                                <b>Lessons 30</b>
                                                                <p>3.1 Ipsuum dolor</p>
                                                            </div>
                                                        </td>
                                                        <td><a href="#">Confirmed</a></td>
                                                        <td><button type="submit"
                                                                class="btn btn-info">Reschedule</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="date">
                                                                <b>Aug 5, Wednesday</b>
                                                                <p>3.00pm - 4.30pm (90min)</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="date">
                                                                <b>Lessons 31</b>
                                                                <p>3.2 Ipsuum dolor</p>
                                                            </div>
                                                        </td>
                                                        <td><a href="#">Confirmed</a></td>
                                                        <td><button type="submit"
                                                                class="btn btn-info">Reschedule</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="date">
                                                                <b>Aug 6, Thursday</b>
                                                                <p>11.00am - 12.00pm (20min)</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="date">
                                                                <b>Lessons 32</b>
                                                                <p>3.3 Ipsuum dolor</p>
                                                            </div>
                                                        </td>
                                                        <td><a href="#">Confirmed</a></td>
                                                        <td><button type="submit"
                                                                class="btn btn-info">Reschedule</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}

                    </div>
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

            </div>

          @include('layouts/footer')

        </div>

    </div>

    <script src="{{ asset('plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ asset('js/calander.js') }}"></script>
    <script src="{{ asset('js/circle-progress.min.js') }}"></script>


</body>

</html>
