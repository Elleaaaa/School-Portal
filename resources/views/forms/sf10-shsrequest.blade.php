<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>COR Request</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Forms</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Form Request</a></li>
                                <li class="breadcrumb-item active">COR</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('sf10shs.get') }}">
                                    @csrf
                                    <div class="row">
                                         {{-- Student Information --}}
                                        {{-- <div class="col-12 text-center">
                                            <h5 class="form-title"><span>Student Information</span></h5>
                                        </div> --}}
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstName" type="text" class="form-control"
                                                    value="{{ old('firstName') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input name="middleName" type="text" class="form-control"
                                                    value="{{ old('middleName') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastName" type="text" class="form-control"
                                                    value="{{ old('lastName') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input name="suffixName" type="text" class="form-control"
                                                    value="{{ old('suffixName') }}" placeholder="Jr, Sr, III, etc">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Auto populate student details when student ID is entered --}}
<script src="{{ asset('js/myjs/populateStudentDetails.js') }}"></script>

</body>

</html>
