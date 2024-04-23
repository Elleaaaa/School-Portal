<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Expenses</title>

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
                            <h3 class="page-title">Expenses</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Expenses</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">

                            <a href="add-expenses.html" class="btn btn-primary">Add Expense <i
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
                                                <th>Item Name</th>
                                                <th>Item Quality</th>
                                                <th>Amount</th>
                                                <th>Purchase Source</th>
                                                <th>Purchase Date</th>
                                                <th>Purchase By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PRE2209</td>
                                                <td>
                                                    <h2>
                                                        <a>Chair</a>
                                                    </h2>
                                                </td>
                                                <td>6</td>
                                                <td>$120</td>
                                                <td>Abc Shop</td>
                                                <td>17 Aug 2020</td>
                                                <td>Lois</td>
                                            </tr>
                                            <tr>
                                                <td>PRE2213</td>
                                                <td>
                                                    <h2>
                                                        <a>Table</a>
                                                    </h2>
                                                </td>
                                                <td>2</td>
                                                <td>$56</td>
                                                <td>Online</td>
                                                <td>05 Aug 2020</td>
                                                <td>Malynne</td>
                                            </tr>
                                            <tr>
                                                <td>PRE2143</td>
                                                <td>
                                                    <h2>
                                                        <a>Desk</a>
                                                    </h2>
                                                </td>
                                                <td>6</td>
                                                <td>$378</td>
                                                <td>Take Away</td>
                                                <td>04 Sept 2020</td>
                                                <td>Levell Scott</td>
                                            </tr>
                                            <tr>
                                                <td>PRE2431</td>
                                                <td>
                                                    <h2>
                                                        <a>Projector</a>
                                                    </h2>
                                                </td>
                                                <td>1</td>
                                                <td>$246</td>
                                                <td>Real Shop</td>
                                                <td>17 Sept 2020</td>
                                                <td>Minnie</td>
                                            </tr>
                                            <tr>
                                                <td>PRE1534</td>
                                                <td>
                                                    <h2>
                                                        <a>Hard disk</a>
                                                    </h2>
                                                </td>
                                                <td>2</td>
                                                <td>$560</td>
                                                <td>Sony Center</td>
                                                <td>02 Oct 2020</td>
                                                <td>Lois A</td>
                                            </tr>
                                            <tr>
                                                <td>PRE2153</td>
                                                <td>
                                                    <h2>
                                                        <a>Note books</a>
                                                    </h2>
                                                </td>
                                                <td>100</td>
                                                <td>$236</td>
                                                <td>DJ Stationary</td>
                                                <td>28 Oct 2020</td>
                                                <td>Calvin</td>
                                            </tr>
                                            <tr>
                                                <td>PRE1252</td>
                                                <td>
                                                    <h2>
                                                        <a>Water Bottle</a>
                                                    </h2>
                                                </td>
                                                <td>267</td>
                                                <td>$237</td>
                                                <td>DJ Stationary</td>
                                                <td>17 Oct 2020</td>
                                                <td>Joe Kelley</td>
                                            </tr>
                                            <tr>
                                                <td>PRE1536</td>
                                                <td>
                                                    <h2>
                                                        <a>Hard disk</a>
                                                    </h2>
                                                </td>
                                                <td>3</td>
                                                <td>$560</td>
                                                <td>music Center</td>
                                                <td>02 Oct 2020</td>
                                                <td>Lois A</td>
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
