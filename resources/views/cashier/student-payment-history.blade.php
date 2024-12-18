<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            font-size: calc(100% - 5px);
        }

        .nomargin {
            margin: 0;
            padding: 0;
        }

        .header {
            font-family: 'Cinzel', serif;
            position: relative;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .header img {
            max-width: 100px;
            /* Adjust image size */
        }

        .logo-left {
            float: left;
            width: 10%;
        }

        .logo-right {
            float: right;
            width: 10%;
        }

        .logo-center {
            display: inline-block;
            text-align: center;
            padding-top: 10px;
            margin-left: -50px;
            text-transform: uppercase;
            font-size: 15px;
            width: 80%;
        }

        .title-liceo {
            font-size: 30px;
            margin: 0;
            padding: 0;
            width: 100%;
            /* Ensures the element takes the full width */
            text-align: center;
            /* Centers the text horizontally */
            letter-spacing: 13px;
            /* Adjust as needed for even spacing between letters */
            display: block;
            /* Ensures the element behaves as a block-level element */
        }

        .student-info p {
            margin: 0px;
        }

        .payment-details {
            width: 80%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .payment-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .payment-table th,
        .payment-table td {
            padding: 10px;
            text-align: center;
        }

        .payment-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .payment-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .payment-table tr:hover {
            background-color: #f1f1f1;
        }

        .payment-table {
            margin-bottom: 100px;
        }

        .cashier-name {
            text-align: right;
            /* Align the entire cashier section to the right */
            margin-top: 20px;
        }

        .cashier-details {
            display: inline-block;
            /* Centers the text and underline together */
            text-align: center;
            /* Ensures name and title are centered relative to the underline */
        }

        .cashier-name-text {
            margin: 0;
        }

        .cashier-underline {
            width: 230px;
            /* Adjustable width */
            margin: 5px auto;
            /* Centers the underline relative to the text */
            border: none;
            border-bottom: 1px solid #000;
        }

        .cashier-title {
            margin: 0;
            font-style: italic;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-left">
            <img src="{{ $imagelogo1 }}" alt="School Logo 2"> <!-- Image 2 on the left -->
        </div>
        <div class="logo-right">
            <img src="{{ $imagelogo2 }}" alt="School Logo 1"> <!-- Image 1 on the right -->
        </div>
        <div class="logo-center">
            <p class="nomargin">The Roman Catholic Bishop of San Pablo, Inc.</p>
            <p class="title-liceo">Liceo De Bay</p>
            <p class="nomargin">Rizal Avenue, Brgy. San Agustin, Bay, Laguna</p>
            <p class="nomargin">Tel. No. (049) 536-0922</p>
        </div>
    </div>

    <div class="payment-details">
        <!-- Student Details Section -->
        <div class="student-info">
            <h3 style="text-align: center;">Student Payment Details</h3>
            <p><strong>Name:</strong> {{ $studentName }}</p>
            <p><strong>Student ID:</strong> {{ $studentId }}</p>
            <p><strong>Section:</strong> {{ $gradeLevel }} - {{ $section }}</p>
            <p><strong>Scholarship:</strong> {{ $scholarType }}</p>
        </div>

        <!-- Payment Table -->
        <div class="payment-table">
            <table>
                <thead>
                    <tr>
                        <th>Date Paid</th>
                        <th>Amount Paid</th>
                        <th>Amount Left</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->created_at->format('M d, Y h:ia') }}</td>
                            <td>{{ $payment->amountPaid }}</td>
                            <td>{{ $payment->amountLeft }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cashier Name Section -->
        <div class="cashier-name">
            <div class="cashier-details">
                <p class="cashier-name-text">{{ $cashier->firstName }} {{ $cashier->middleName }}
                    {{ $cashier->lastName }}</p>
                <hr class="cashier-underline">
                <p class="cashier-title"><strong>Cashier</strong></p>
            </div>
        </div>
    </div>



</body>

</html>
