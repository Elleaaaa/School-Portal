<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">


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
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-one w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>555</h3>
                                        <h6>Students</h6>
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
                                        <h3>50+</h3>
                                        <h6>Awards</h6>
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
                                        <h3>30+</h3>
                                        <h6>Department</h6>
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
                                        <h3>$505</h3>
                                        <h6>Revenue</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    {{-- <div class="col-auto text-right float-right ml-auto">
                        <a href="add-events.html" class="btn btn-primary"> Add Event <i class="fas fa-plus"></i></a>
                    </div> --}}
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade none-border" id="my_event">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Event</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-success save-event submit-btn">Create
                                    event</button>
                                <button type="button" class="btn btn-danger delete-event submit-btn"
                                    data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('layouts/footer')
    </div>
    </div>

    <script src="{{ asset('js/moment.min.js') }}"></script>


    <script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/jquery.fullcalendar.js') }}"></script>


</body>


</html>
