<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Select Section</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .clickable-box {
            background-color: lightblue;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .clickable-box:hover {
            background-color: #87ceeb;
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
                            <h3 class="page-title">Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <h3>Grade Level</h3>
                                <div class="row mb-4">
                                    <!-- Section A -->
                                    <div class="col-lg-6 col-md-6">
                                        <h4 class="mt-3">Section A</h4>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex">
                                                <div class="card bg-success w-100">
                                                    <div class="card-body">
                                                        <div
                                                            class="db-widgets d-flex justify-content-between align-items-center">
                                                            <div class="db-icon">
                                                                <i class="fas fa-user-check"></i>
                                                            </div>
                                                            <div class="db-info">
                                                                <p>asd</p>
                                                                <h6>Present Today</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 d-flex">
                                                <div class="card bg-danger w-100">
                                                    <div class="card-body">
                                                        <div
                                                            class="db-widgets d-flex justify-content-between align-items-center">
                                                            <div class="db-icon">
                                                                <i class="fas fa-user-times"></i>
                                                            </div>
                                                            <div class="db-info">
                                                                <p>asd</p>
                                                                <h6>Absent Today</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @foreach ($gradeLevels as $gradeLevel)
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <h3 style="text-align: center;">{{ $gradeLevel }}</h3>
                    <div class="row mb-4">
                        @if (isset($allSections[$gradeLevel]))
                            @foreach ($allSections[$gradeLevel] as $section)
                                <div class="col-lg-6 col-md-6">
                                    <h4 class="mt-3" style="text-align: center;">{{ $section->sectionName }}</h4>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex">
                                            <div class="card bg-success w-100">
                                                <div class="card-body">
                                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                                        <div class="db-icon">
                                                            <i class="fas fa-user-check"></i>
                                                        </div>
                                                        <div class="db-info">
                                                            <span style="font-size: 20px;">{{ $presentsBySection[$section->sectionName] ?? 0 }}</span><span> Students</span>
                                                            <h6>Present Today</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 d-flex">
                                            <div class="card bg-danger w-100">
                                                <div class="card-body">
                                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                                        <div class="db-icon">
                                                            <i class="fas fa-user-times"></i>
                                                        </div>
                                                        <div class="db-info">
                                                            <!-- Display absent count -->
                                                            <span style="font-size: 20px;">{{ $absenteesBySection[$section->sectionName] ?? 0 }}</span><span> Students</span>
                                                            <h6>Absent Today</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No sections available for {{ $gradeLevel }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

            



                @include('layouts/footer')
            </div>
        </div>


</body>

</html>
