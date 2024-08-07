<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Fees Collections</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
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
                            <h3 class="page-title">Fees Collections</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Fees Collections</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="add-fees-collection.html" class="btn btn-primary">Add Fee <i
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Fees Type</th>
                                                <th>Amount</th>
                                                <th>Paid Date</th>
                                                <th class="text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PRE2209</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-01.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Aaliyah</a>
                                                    </h2>
                                                </td>
                                                <td>Female</td>
                                                <td>Mess Fees</td>
                                                <td>$120</td>
                                                <td>17 Aug 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2213</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-02.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Malynne</a>
                                                    </h2>
                                                </td>
                                                <td>Female</td>
                                                <td>Class Test</td>
                                                <td>$56</td>
                                                <td>05 Aug 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2143</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-03.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Levell Scott</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Exam Fees</td>
                                                <td>$378</td>
                                                <td>04 Sept 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2431</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-04.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Minnie</a>
                                                    </h2>
                                                </td>
                                                <td>Female</td>
                                                <td>Exam Fees</td>
                                                <td>$246</td>
                                                <td>17 Sept 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-danger">Unpaid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE1534</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-05.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Lois A</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Exam Fees</td>
                                                <td>$56</td>
                                                <td>02 Oct 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-danger">Unpaid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2153</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-06.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Calvin</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Exam Fees</td>
                                                <td>$236</td>
                                                <td>28 Oct 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-danger">Unpaid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE1252</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-07.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Joe Kelley</a>
                                                    </h2>
                                                </td>
                                                <td>Female</td>
                                                <td>Transport Fees</td>
                                                <td>$237</td>
                                                <td>17 Oct 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE1434</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-08.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Vincent</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Mess Fees</td>
                                                <td>$567</td>
                                                <td>05 Nov 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2345</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-09.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Kozma  Tatari</a>
                                                    </h2>
                                                </td>
                                                <td>Female</td>
                                                <td>Exam Fees</td>
                                                <td>$564</td>
                                                <td>12 Nov 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE2365</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-10.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>John Chambers</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Class Test</td>
                                                <td>$234</td>
                                                <td>15 Nov 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PRE1234</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('img/profiles/avatar-11.jpg') }}"
                                                                alt="User Image"></a>
                                                        <a>Nathan Humphries</a>
                                                    </h2>
                                                </td>
                                                <td>Male</td>
                                                <td>Exam Fees</td>
                                                <td>$278</td>
                                                <td>17 Nov 2020</td>
                                                <td class="text-right">
                                                    <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
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
</body>

</html>
