<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Schedule List</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Time Table</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Time Table</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="{{ route('add-timetable.show') }}" class="btn btn-primary">Add Schedule <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th>Section</th>
                                                <th>Teacher</th>
                                                <th>Subject</th>
                                                <th>Day</th>
                                                <th>Room</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lessons as $lesson)
                                            <tr>
                                                <td>{{$lesson->sectionId}}</td>
                                                <td>
                                                    {{ $lesson->teacher->firstName }} {{ $lesson->teacher->lastName }}
                                                </td>
                                                <td>{{$lesson->subjectId}}</td>
                                                <td>{{$lesson->day}}</td>
                                                <td>{{$lesson->room}}</td>
                                                <td>{{$lesson->start_time}}</td>
                                                <td>{{$lesson->end_time}}</td>
                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a href="{{ route('edit-timetable.show', ['id' => $lesson->id]) }}"
                                                            class="btn btn-sm bg-success-light mr-2">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('layouts/footer')
        </div>
    </div>

    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 10
            });
        });
    </script>

</body>

</html>
