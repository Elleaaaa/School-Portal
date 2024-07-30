<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Fees</title>

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
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label for="gradeLevel">Grade Level</label>
                                                <input type="text" class="form-control" name="gradeLevel" id="gradeLevel" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label for="classType">Class Type</label>
                                                <input type="text" class="form-control" name="classType" id="classType" readonly>
                                            </div>
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
                                                        <option value="{{ $feeList->feeName }}">{{ $feeList->feeName }} - {{ $feeList->gradeLevel }} - {{ $feeList->classType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Fees Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Amount Paid</label>
                                                <input type="number" class="form-control" name="amountPaid" id="amountPaid" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" class="form-control" name="discount" id="discount" placeholder="input 20 if 20%" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discount Amount</label>
                                                <input type="number" class="form-control" name="discountAmount" id="discountAmount" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Discounted Price</label>
                                                <input type="number" class="form-control" name="discountedPrice" id="discountedPrice" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label >Reciever</label>
                                                <input readonly type="text" class="form-control" name="reciever" value="{{ $cashiers->firstName }} {{ $cashiers->lastName }}">
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
    </script>

    <script src="{{ asset('js/myjs/populateStudentDetails.js') }}"></script>
    <script src="{{ asset('js/myjs/fetchGradeLevel.js') }}"></script>
    <script src="{{ asset('js/myjs/discountCalculator.js') }}"></script>
    <script src="{{ asset('js/myjs/preventInput.js') }}"></script>

</body>

</html>
