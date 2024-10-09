<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <title>Enroll Student</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        input[type="checkbox"] {
        transform: scale(1.5);
        margin-right: 10px;
        margin-left: 20px;
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
                            <h3 class="page-title">Enroll Student</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Enroll</a></li>
                                <li class="breadcrumb-item active">Enroll Student</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form  id="check-payment-form" method="POST" action="{{ route('enroll-student.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Enrollment Form</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                       
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middleName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input type="text" class="form-control" name="suffixName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel" required>
                                                    <option value=""></option>
                                                    <option value="Grade 7">Grade 7</option>
                                                    <option value="Grade 8">Grade 8</option>
                                                    <option value="Grade 9">Grade 9</option>
                                                    <option value="Grade 10">Grade 10</option>
                                                    <option value="Grade 11">Grade 11</option>
                                                    <option value="Grade 12">Grade 12</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="strand">Strand</label>
                                                <select class="form-control" name="strand">
                                                    <option></option>
                                                    <option value="STEM">STEM</option>
                                                    <option value="HUMSS">HUMSS</option>
                                                    <option value="ABM">ABM</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                               {{-- section will be display here --}}
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select class="form-control" name="semester">
                                                    <option></option>
                                                    <option value="First Semester">First Semester</option>
                                                    <option value="Second Semester">Second Semester</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group" id="subjectContainer">
                                                <!-- Subjects will be dynamically added here -->
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" id="selectedSubjects" name="subjects" hidden>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="classType">Class Type</label>
                                                <select class="form-control" name="classType">
                                                    <option value=""></option>
                                                    <option value="Regular Class">Regular Class</option>
                                                    <option value="Special Science Class">Special Science Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="Enrolled">Enrolled</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Enroll Student</button>
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
@include('layouts/footer')


    {{-- FETCH SECTION BASED ON GRADE LEVEL --}}
    <script src="{{ asset('js/myjs/fetchSection.js') }}"></script>

    {{-- DISPLAY SUBJECTS DEPENDS ON GRADE LEVEL --}}
    <script src="{{ asset('js/myjs/displaySubjects.js') }}"></script>

    {{-- Auto populate student details when student ID is entered --}}
    <script src="{{ asset('js/myjs/populateStudentDetails.js') }}"></script>

    {{-- CHECK IF STUDENT HAS PAID ALREADY --}}
    <script src="{{ asset('js/myjs/checkpaymentstatus.js') }}"></script>
</body>

</html>
