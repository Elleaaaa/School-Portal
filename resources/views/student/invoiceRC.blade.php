<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .total-amount {
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">

                <h2>Payment Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tuition Fee (Monthly)</td>
                            <td>₱ 924.00</td>
                        </tr>
                        <tr>
                            <td>Compuiter Fee (Monthly)</td>
                            <td>₱ 200.00</td>
                        </tr>
                        <tr>
                            <td>GENYO E-Learning</td>
                            <td>₱ 200.00</td>
                        </tr>
                        <tr>
                            <td>Energy Fee</td>
                            <td>₱ 200.00</td>
                        </tr>
                        <tr>
                            <td class="text-right">WHOLE YEAR TUITION FEES</td>
                            <td>₱ 15,240.00</td>
                        </tr>
                        <tr>
                            <td>Additional Fee (New Student)</td>
                            <td>₱ 100.00</td>
                        </tr>
                        <tr>
                            <td>Miscellaneous Fees</td>
                            <td>₱ 1,340.00</td>
                        </tr>
                        <tr>
                            <td>Other School Fees</td>
                            <td>₱ 4,530.00</td>
                        </tr>
                        <tr>
                            <td>APTA/SSG/CLUB Membership Fees</td>
                            <td>₱ 200.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="total">TOTAL FEES (WHOLE YEAR):</td>
                            <td class="total-amount">₱{{ number_format($tuitionFee->amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <h2>Payment History</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Receipt #</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Recieved by</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feeHistory as $FH)
                            <tr>
                                <td>{{$FH->feeReceiptId}}</td>
                                <td>{{$FH->amountPaid}}</td>
                                <td>{{$FH->created_at}}</td>
                                <td>{{$FH->reciever}}</td>
                                <td>{{$FH->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="total">TOTAL PAYMENT:</td>
                            <td class="total-amount">₱{{ number_format($totalAmountPaid, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
