<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Activity Logs</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .table .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table td span {
            cursor: pointer;
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
                            <h3 class="page-title">Activity Logs</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Activity Logs</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="{{ route('addsubject.show') }}" class="btn btn-primary">Add Subject <i
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
                                                <th>User</th>
                                                <th>Activity</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td>{{ $log->studentId }}</td>
                                                    <td>{{ $log->type }}</td>
                                                    <td>
                                                        <span class="d-inline-block text-truncate"
                                                            style="max-width: 200px; cursor: pointer;"
                                                            data-state="truncated" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="{{ $log->activity }}"
                                                            onclick="toggleDescription(this)">
                                                            {{ $log->activity }}
                                                        </span>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y h:ia') }}</td>

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
                "pageLength": 10,
            });
        });
    </script>

    <script>
        function toggleDescription(element) {
            const isTruncated = element.getAttribute('data-state') === 'truncated';

            if (isTruncated) {
                // Expand the text
                element.style.maxWidth = 'none'; // Remove width restriction
                element.classList.remove('text-truncate'); // Remove truncation class
                element.setAttribute('data-state', 'expanded'); // Update state
                $(element).tooltip('hide'); // Hide tooltip
            } else {
                // Truncate the text again
                element.style.maxWidth = '200px'; // Reapply width restriction
                element.classList.add('text-truncate'); // Reapply truncation class
                element.setAttribute('data-state', 'truncated'); // Update state
            }
        }
    </script>

</body>

</html>
