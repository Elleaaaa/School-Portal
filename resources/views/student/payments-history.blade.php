<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Payment History</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">

    <style>
        .progress-bar {
            font-size: 16px;
            /* Larger font for better readability */
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
                            <h3 class="page-title">Payment History</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Payments</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="status-bar">
                    <h5>Payment Progress</h5>

                    @if ($tuitionAmount > 0)
                        <div class="progress mb-3" style="height: 50px;">
                            <!-- Increased the height of the progress bar -->
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ ($totalAmount / $tuitionAmount) * 100 }}%;"
                                aria-valuenow="{{ $totalAmount }}" aria-valuemin="0"
                                aria-valuemax="{{ $tuitionAmount }}">
                                {{ round(($totalAmount / $tuitionAmount) * 100, 2) }}% <!-- Display percentage -->
                            </div>
                        </div>

                        {{-- Display amounts --}}
                        <p><strong>Amount Paid:</strong> ₱{{ number_format($totalAmount, 2) }}</p>
                        <p><strong>Total Tuition Fee:</strong> ₱{{ number_format($tuitionAmount, 2) }}</p>

                        {{-- Thank You Message for Full Payment --}}
                        @if ($totalAmount / $tuitionAmount == 1)
                            <h4 class="text-success font-weight-bold text-center">Thank you for completing your payment!
                            </h4>
                        @endif
                    @else
                        <p>No tuition fee data available for the current school year.</p>
                        <!-- Message when tuition amount is 0 -->
                    @endif
                </div>




                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="paymentHistory" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>Payment ID</th> --}}
                                                {{-- <th>Fees Name</th> --}}
                                                <th>Amount</th>
                                                {{-- <th>Discounted Price</th>
                                                <th>Amount Paid</th>
                                                <th>Discount</th>
                                                <th>Discount Amount</th> --}}
                                                <th>Balance</th>
                                                <th>Received by:</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feeHistory as $fHistory)
                                                <tr data-href="{{ route('invoice.show') }}">
                                                    {{-- <td>{{$fHistory->feeId}}</td> --}}
                                                    {{-- <td>{{$fHistory->feeType}}</td> --}}
                                                    <td>{{ $fHistory->amount }}</td>
                                                    {{-- <td>{{$fHistory->discountedPrice}}</td>
                                                <td>{{$fHistory->amountPaid}}</td>
                                                <td>{{$fHistory->discount}}</td>
                                                <td>{{$fHistory->discountAmount}}</td> --}}
                                                    <td>{{ $fHistory->amountLeft }}</td>
                                                    <td>{{ $fHistory->reciever }}</td>
                                                    <td>{{ $fHistory->status }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($fHistory->created_at)->format('M d, Y h:ia') }}
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

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>

    <script>
        new DataTable('#paymentHistory', {
            lengthMenu: [5, 10, 25, 50, 100, {
                label: 'All',
                value: -1
            }],
            layout: {
                top1Start: {
                    buttons: [{
                        text: 'Export As',
                        split: ['pdf', ],
                    }],
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("tr[data-href]");
            rows.forEach(row => {
                row.addEventListener("click", function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>


</body>

</html>
