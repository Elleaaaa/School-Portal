<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Payment History</title>


    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
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

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="paymentHistory" class="display nowrap" style="width:100%" >
                                        <thead>
                                            <tr>
                                                <th>Payment ID</th>
                                                <th>Fees Name</th>
                                                <th>Amount</th>
                                                <th>Discounted Price</th>
                                                <th>Amount Paid</th>
                                                <th>Discount</th>
                                                <th>Discount Amount</th>
                                                <th>Amount Left</th>
                                                <th>Receiver</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feeHistory as $fHistory)
                                            <tr>
                                                <td>{{$fHistory->feeId}}</td>
                                                <td>{{$fHistory->feeType}}</td>
                                                <td>{{$fHistory->amount}}</td>
                                                <td>{{$fHistory->discountedPrice}}</td>
                                                <td>{{$fHistory->amountPaid}}</td>
                                                <td>{{$fHistory->discount}}</td>
                                                <td>{{$fHistory->discountAmount}}</td>
                                                <td>{{$fHistory->amountLeft}}</td>
                                                <td>{{$fHistory->reciever}}</td>
                                                <td>{{$fHistory->status}}</td>
                                                <td>{{$fHistory->created_at}}</td>
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
        lengthMenu: [5, 10, 25, 50, 100, { label: 'All', value: -1 }],
         layout: {
         top1Start: {
             buttons: [
                 {
                     text: 'Export As',
                     split: ['pdf', 'excel', 'csv', 'copy', 'print',],
                 }
             ],
         }
     }
     });
     </script>
  

</body>

</html>
