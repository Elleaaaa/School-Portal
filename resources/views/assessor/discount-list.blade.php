<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Subjects</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .btn.rounded-circle {
            border-radius: 50%;
            width: 25px;
            /* Adjust size as needed */
            height: 25px;
            /* Adjust size as needed */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px solid black;
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
                            <h3 class="page-title">Discounts</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Discounts</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="{{ route('add-discount.show') }}" class="btn btn-primary">Add Discount <i
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
                                                <th>Discount Type</th>
                                                <th>Percentage</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($discounts as $discount)
                                                <tr>
                                                    <td>{{ $discount->discountType }}</td>
                                                    <td>{{ $discount->percentage }}</td>
                                                    <td>{{ $discount->amount }}</td>
                                                    <td>
                                                        <div class="actions">
                                                            <a class="btn btn-sm rounded-circle bg-{{ $discount->status == 'active' ? 'success' : 'danger' }}"
                                                                onclick="toggleStatus('{{ $discount->id }}', '{{ $discount->status }}')"
                                                                id="statusButton{{ $discount->id }}">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="actions">
                                             <a href="{{ route('edit-discount.show', ['id' => $discount->id]) }}" class="btn btn-sm bg-success-light mr-2">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                             {{-- <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a> --}}
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

    <script>
        function toggleStatus(id, currentStatus) {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send an AJAX request to update the status
            fetch(`/assessor/toggle-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        status: currentStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Update the button color and text based on the new status
                    const button = document.getElementById(`statusButton${id}`);
                    if (data.status === 'active') {
                        button.classList.remove('bg-danger');
                        button.classList.add('bg-success');
                        button.textContent = '';
                    } else {
                        button.classList.remove('bg-success');
                        button.classList.add('bg-danger');
                        button.textContent = '';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
