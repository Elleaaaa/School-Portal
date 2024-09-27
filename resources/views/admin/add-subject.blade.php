<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Subject</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body>

    <div class="main-wrapper">

        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                                <li class="breadcrumb-item active">Add Subject</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('subject.add') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Subject Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectType">Grade Level</label>
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
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="strand">Strand</label>
                                                <select class="form-control" id="strand" name="strand">
                                                    <option value=""></option>
                                                    <option value="STEM">STEM</option>
                                                    <option value="ABM">ABM</option>
                                                    <option value="GAS">GAS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-control" id="section" name="section" required>
                                                    {{-- section will be display here --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select class="form-control" id="semester" name="semester">
                                                    <option value=""></option>
                                                    <option value="First Semester">First Semester</option>
                                                    <option value="Second Semester">Second Semester</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Subject Title</label>
                                                <input name="subjectTitle" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectType">Subject Type</label>
                                                <select class="form-control" id="subjectType" name="subjectType"
                                                    required>
                                                    <option value=""></option>
                                                    <option value="General Subject">General Subject</option>
                                                    <option value="Core">Core</option>
                                                    <option value="Applied">Applied</option>
                                                    <option value="Specialized">Specialized</option>
                                                    <option value="Other_Subjects">Other_Subjects</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="subjectTeacher">Subject Teacher</label>
                                                <select name="subjectTeacher" id="subjectTeacher" class="form-control"
                                                    required>
                                                    <option value="" selected disabled>Select Subject Teacher
                                                    </option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->teacherId }}"
                                                            data-name="{{ $teacher->firstName . ' ' . $teacher->lastName }}">
                                                            {{ $teacher->firstName . ' ' . $teacher->lastName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label hidden>Teacher ID</label>
                                                <input name="teacherId" id="teacherId" class="form-control" hidden>
                                            </div>
                                            <div class="form-group">
                                                <label hidden>Teacher Name</label>
                                                <input name="teacherName" id="teacherName" class="form-control" hidden>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Add</button>
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

    {{-- FETCH SECTION BASED ON GRADE LEVEL --}}
    <script src="{{ asset('js/myjs/fetchSection.js') }}"></script>

    {{-- FETCH TEACHER ID TO SAVE IN DB --}}
    <script src="{{ asset('js/myjs/fetchTeacherId.js') }}"></script>

</body>

</html>
