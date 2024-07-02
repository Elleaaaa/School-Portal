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
                            <h3 class="page-title">Add Section</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Sections</a></li>
                                <li class="breadcrumb-item active">Add Section</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('failed'))
                    <div id="failedAlert" class="alert alert-failed">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('add-section.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Section Information</span></h5>
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
                                                <label>Section</label>
                                                <input name="section" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Section Name</label>
                                                <input name="sectionName" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="sectionTeacher">Section Teacher</label>
                                                <select name="sectionTeacher" id="subjectTeacher" class="form-control">
                                                    <option value="" selected disabled>Select Subject Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->teacherId }}">{{ $teacher->firstName . ' ' . $teacher->lastName }}</option>
                                                    @endforeach
                                                </select>
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

    {{-- TIMER FOR ALERTS --}}
    <script src="{{ asset('js/myjs/timerAlert.js') }}"></script>

</body>

</html>
