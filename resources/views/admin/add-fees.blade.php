<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Smartious - Add Fees</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <div class="main-wrapper">
        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Fees</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="fees-collections.html">Accounts</a></li>
                                <li class="breadcrumb-item active">Add Fees</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{route('addfees.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Fees Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" id="studentId">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                        {{-- for design only --}}
                                        </div>
                                       
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="firstName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middleName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lastName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input type="text" class="form-control" name="suffixName" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Fees Type</label>
                                                <select class="form-control" name="feeType">
                                                    <option value="" selected disabled>Select Type</option>
                                                    @foreach($feeLists as $feeList)
                                                        <option value="{{ $feeList->feeName }}">{{ $feeList->feeName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Fees Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Amount Paid</label>
                                                <input type="number" class="form-control" name="amountPaid" id="amountPaid">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" class="form-control" name="discount" id="discount" placeholder="input 20 if 20%">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discount Amount</label>
                                                <input type="number" class="form-control" name="discountAmount" id="discountAmount" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discounted Price</label>
                                                <input type="number" class="form-control" name="discountedPrice" id="discountedPrice" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label >Reciever</label>
                                                <input readonly type="text" class="form-control" name="reciever" value="{{ $admins->firstName }} {{ $admins->lastName }}">
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Paid Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


 
    <script>
        // Auto populate student details when student ID is entered
        document.addEventListener('DOMContentLoaded', function() {
            // Get the input field
            var studentIdInput = document.getElementById('studentId');

            // Add event listener for keypress event
            studentIdInput.addEventListener('keypress', function(event) {
                // Check if Enter key was pressed (key code 13)
                if (event.key === 'Enter') {
                    // Prevent the default form submission behavior
                    event.preventDefault();
                    
                    // Perform the same action as when the button is clicked
                    var studentId = studentIdInput.value;
                    fetchData(studentId);
                }
            });

            // Function to fetch student data
            function fetchData(studentId) {
                // AJAX request to fetch student data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/fetch-student-details', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                
                // Retrieve CSRF token from a meta tag in the HTML
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var studentDetails = JSON.parse(xhr.responseText);
                            // Check if student details are found
                            if (studentDetails && Object.keys(studentDetails).length > 0) {
                                // Populate the details fields with the received data
                                document.querySelector('input[name="firstName"]').value = studentDetails.firstName;
                                document.querySelector('input[name="middleName"]').value = studentDetails.middleName;
                                document.querySelector('input[name="lastName"]').value = studentDetails.lastName;
                                document.querySelector('input[name="suffixName"]').value = studentDetails.suffix;
                            } else {
                                // Display a message if no student is found
                                alert('No student found with the provided ID');
                                // Clear the fields if no student is found
                                document.querySelector('input[name="firstName"]').value = '';
                                document.querySelector('input[name="middleName"]').value = '';
                                document.querySelector('input[name="lastName"]').value = '';
                                document.querySelector('input[name="suffixName"]').value = '';
                            }
                        } else if (xhr.status === 404) {
                            // Handle the case where the student is not found
                            alert('No student found with the provided ID');
                            // Clear the fields if no student is found
                            document.querySelector('input[name="firstName"]').value = '';
                            document.querySelector('input[name="middleName"]').value = '';
                            document.querySelector('input[name="lastName"]').value = '';
                            document.querySelector('input[name="suffixName"]').value = '';
                        } else {
                            console.error('Error fetching student data');
                        }
                    }
                };
                xhr.send(JSON.stringify({ studentId: studentId }));
            }
        });
        // Auto populate student details when student ID is entered

        // calculate the discount
        function calculateDiscount() {
            var originalPrice = parseFloat(document.getElementById('amount').value);
            var discountPercentage = parseFloat(document.getElementById('discount').value);

            // Calculate discount amount
            var discountAmount = (originalPrice * discountPercentage) / 100;

            // Calculate discounted price
            var discountedPrice = originalPrice - discountAmount;

            // Update the input fields with the calculated values
            document.getElementById('discountAmount').value = discountAmount.toFixed(2);
            document.getElementById('discountedPrice').value = discountedPrice.toFixed(2);
        }

        // Attach event listener to recalculate on input change for both original price and discount
        document.getElementById('amount').addEventListener('input', calculateDiscount);
        document.getElementById('discount').addEventListener('input', calculateDiscount);

        // Initial calculation when page loads
        calculateDiscount();
        // calculate the discount


        // auto populate the fee amount based on selected fee type
        $(document).ready(function() {
            $('select[name="feeType"]').change(function() {
                var selectedFeeName = $(this).val(); // Get the selected fee name
                var selectedFee = {!! $feeLists->toJson() !!}.find(function(fee) {
                    return fee.feeName === selectedFeeName;
                });
                if (selectedFee) {
                    $('#amount').val(selectedFee.amount); // Update the "Fees Amount" input with the selected fee's amount
                } else {
                    $('#amount').val(''); // Clear the "Fees Amount" input if no fee is selected
                }
            });
        });
        // auto populate the fee amount based on selected fee type

         // Get the status from the session
    var status = "{{ session('status') }}";

// Check if the status is success or failure and show the appropriate message
if (status === 'success') {
    alert('Paid Successfully');
} else if (status === 'failure') {
    alert('Payment Failed');
}
    </script>

    

</body>

</html>
