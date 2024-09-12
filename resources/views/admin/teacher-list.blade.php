<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>All Teachers</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
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
                            <h3 class="page-title">Teachers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Teachers</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="add-teacher.html" class="btn btn-primary">Add Teacher <i
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>AGE</th>
                                                <th>Subjects</th>
                                                <th>Mobile Number</th>
                                                <th>Address</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $teacher)
                                            <tr>
                                                {{-- <td>{{$paddedTeacherId = str_pad($teacher->teacherId, 4, '0', STR_PAD_LEFT)}}</td> --}}
                                                <td>{{$teacher->teacherId}}</td>
                                                <td>
                                                    @foreach ($images as $image)
                                                    @if ($image->studentId == $teacher->teacherId)
                                                    <h2 class="table-avatar">
                                                        <a href="teacher-details.html"
                                                            class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('storage/images/display-photo/' . $image->displayPhoto) }}"
                                                                alt="User Image"></a>
                                                        <a href="teacher-details.html">{{$teacher->firstName . $teacher->lastname}}</a>
                                                    </h2>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$teacher->age}}</td>
                                                <td>
                                                    @foreach ($subjects as $subject)
                                                        @if ($subject->teacherId == $teacher->teacherId)
                                                            {{ $subject->subject }}
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$teacher->mobileNumber}}</td>
                                                <td>
                                                    @foreach ($addresses as $address)
                                                        @if ($address->studentId == $teacher->teacherId)
                                                            {{ $address->address }} {{ $address->baranggay }}, {{ $address->city }}, {{ $address->province }}, {{ $address->region }}
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a href="{{ route('edit-teacher.show', ['id' => $teacher->id]) }}" class="btn btn-sm bg-success-light mr-2">
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
