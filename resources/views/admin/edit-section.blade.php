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
                            <h3 class="page-title">Edit Section</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">Sections</a></li>
                                <li class="breadcrumb-item active">Edit Section</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('edit-section.update', ['id' => $sections->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Section Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <select class="form-control" id="gradeLevel" name="gradeLevel" required>
                                                    <option value=""></option>
                                                    <option value="Grade 7" {{ $sections->gradeLevel === 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                                    <option value="Grade 8" {{ $sections->gradeLevel === 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                                    <option value="Grade 9" {{ $sections->gradeLevel === 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                                    <option value="Grade 10" {{ $sections->gradeLevel === 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                                    <option value="Grade 11" {{ $sections->gradeLevel === 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                                    <option value="Grade 12" {{ $sections->gradeLevel === 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <input name="section" type="text" class="form-control" value="{{$sections->section}}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Section Name</label>
                                                <input name="sectionName" type="text" class="form-control" value="{{$sections->sectionName}}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="sectionTeacher">Section Teacher</label>
                                                <select name="sectionTeacher" id="sectionTeacher" class="form-control" required>
                                                    <option value="" disabled>Select Section Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->teacherId }}" {{ $teacher->teacherId === $sections->teacherId ? 'selected' : '' }}>
                                                            {{ $teacher->firstName }} {{ $teacher->lastName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="active" {{ $sections->status === 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $sections->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
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

</body>

</html>
