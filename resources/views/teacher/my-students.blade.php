<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>My Students</title>
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
                            <h3 class="page-title">Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myStudents" class="table table-hover table-center mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>DOB</th>
                                                <th>Section</th>
                                                <th>Mobile Number</th>
                                                {{-- <th class="text-right">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($myStudents as $student)
                                                <tr>
                                                    <td>{{ $student->studentId }}</td>
                                                    <td>
                                                        @foreach ($images as $image)
                                                            @if ($image->studentId == $student->studentId)
                                                                <h2 class="table-avatar">
                                                                    <a href="teacher-details.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ asset('storage/images/display-photo/' . $image->displayPhoto) }}"
                                                                            alt="User Image">
                                                                    </a>
                                                                    {{-- {{ $student->name }} --}}
                                                                    @foreach ($studentDetails as $studentDetail)
                                                                        @if ($studentDetail->studentId == $student->studentId)
                                                                            {{ $studentDetail->lastName . ' ' . $studentDetail->firstName . ' ' . $studentDetail->suffix }}
                                                                        @endif
                                                                    @endforeach
                                                                </h2>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($studentDetails as $studentDetail)
                                                            @if ($studentDetail->studentId == $student->studentId)
                                                                {{ $studentDetail->age }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($studentDetails as $studentDetail)
                                                            @if ($studentDetail->studentId == $student->studentId)
                                                                {{ $studentDetail->birthday }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($myStudents as $studentDetail)
                                                            @if ($studentDetail->studentId == $student->studentId)
                                                                {{ $studentDetail->section }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($studentDetails as $studentDetail)
                                                            @if ($studentDetail->studentId == $student->studentId)
                                                                {{ $studentDetail->mobileNumber }}
                                                            @endif
                                                        @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script>
        function processLogoImage(imagePath, callback) {
            const logoImage = new Image();
            logoImage.src = imagePath;

            logoImage.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = logoImage.width;
                canvas.height = logoImage.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(logoImage, 0, 0);
                const base64Image = canvas.toDataURL();

                callback(base64Image);
            };

            logoImage.onerror = function() {
                console.error('Failed to load logo image.');
            };
        }

        function initializeDataTable(base64Image) {
            new DataTable('#myStudents', {
                lengthMenu: [5, 10, 25, 50, 100, {
                    label: 'All',
                    value: -1
                }],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Export As PDF',
                    title: '',
                    message: '',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    customize: function(doc) {
                        // Set margins for the page
                        doc.pageMargins = [40, 40, 40, 40];

                        doc.content.splice(0, 0, {
                            image: base64Image,
                            width: 80,
                            alignment: 'center',
                            margin: [0, 0, 0,
                                0
                            ]
                        });

                        doc.content.splice(1, 0, {
                            text: 'My Students',
                            alignment: 'center',
                            fontSize: 18,
                            margin: [0, 0, 0,
                                0
                            ]
                        });

                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                }]

            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            const imagePath = '{{ asset('img/logo/baylogo.png') }}';
            processLogoImage(imagePath, initializeDataTable);
        });
    </script>



</body>

</html>
