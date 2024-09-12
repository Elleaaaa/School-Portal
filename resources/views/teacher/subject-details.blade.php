<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Portal</title>
    <style>
        .box {
            padding: 20px;
            margin: 10px 0;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .box h2 {
            margin-bottom: 20px;
        }

        .container-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .container-custom .box {
            flex: 0 0 48%;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .container-custom .box {
                flex: 0 0 100%;
            }
        }

        /* upload icon display */
        .custom-file-input {
            display: none;
        }

        .uploadButton {
        cursor: pointer;
        font-size: 1.5rem;
        color: gray;
        background-color: #f0f0f0; /* light gray background */
        border-radius: 50%; /* make it a circle */
        padding: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        position: relative; /* To position the tooltip */
        }

        .uploadButton::after {
            content: "upload file";
            position: absolute;
            bottom: 100%; /* Position above the button */
            left: 50%;
            transform: translateX(-50%);
            background-color: black;
            color: white;
            padding: 5px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            font-size: 0.8rem;
            z-index: 10; /* Ensure tooltip is on top */
        }

        .uploadButton:hover::after {
            opacity: 1;
            visibility: visible;
        }



            .file-input-wrapper {
                display: inline-block;
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
                            <h3 class="page-title">Subjects</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('teacher-subjectlist.show', ['teacherId' => Auth::user()->studentId]) }}">Subjects</a></li>
                                <li class="breadcrumb-item active">{{$subject->subjectTitle}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="container-custom">
                        <div class="box">
                            <form id="uploadForm" method="POST" action="{{ route('uploadFile.store', ['id' => $subjectId]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="file-input-wrapper">
                                    <input id="file" name="file" type="file" class="custom-file-input" style="display: none;">
                                    <label class="uploadButton" for="file">
                                        <i class="fas fa-upload"></i>
                                    </label>
                                </div>
                            </form>
                            <ul class="list-group">
                                @foreach($files as $file)
                                    <li class="list-group-item"><a href="{{ asset('storage/uploads/'.$teacherId.'/'.$file->fileName).'/'.$subjectId }}"> {{ $file->fileName }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="box">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="file-input-wrapper">
                                    <input id="file" name="file" type="file" class="custom-file-input">
                                    <label class="uploadButton" for="file">
                                        <i class="fas fa-upload"></i>
                                    </label>
                                </div>
                            <ul class="list-group">
                                <li class="list-group-item">Quiz 1</li>
                                <li class="list-group-item">Quiz 2</li>
                                <li class="list-group-item">Exam 1</li>
                                <li class="list-group-item">Exam 2</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function() {
            var form = document.getElementById('uploadForm');
            form.submit();
        });
    </script>

</body>

</html>
