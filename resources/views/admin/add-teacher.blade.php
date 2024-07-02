<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Teachers</title>

<style>
    .error-text {
    color: red;
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
                            <h3 class="page-title">Add Teachers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="teachers.html">Teachers</a></li>
                                <li class="breadcrumb-item active">Add Teachers</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('failed'))
                    <div id="failedAlert" class="alert alert-failed">
                        {{ session('failed') }}
                    </div>
                @endif
            
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('addteacher.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Basic Details</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstName" type="text" class="form-control" value="{{ old('firstName') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input name="middleName" type="text" class="form-control" value="{{ old('middleName') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastName" type="text" class="form-control" value="{{ old('lastName') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input name="suffixName" type="text" class="form-control" placeholder="Jr, Sr, III, etc" value="{{ old('suffixName') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control">
                                                    <option readonly>Select Gender</option>
                                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Others" {{ old('gender') === 'Others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input name="birthday" type="date" class="form-control" value="{{ old('birthday') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="age" type="text" class="form-control" value="{{ old('age') }}" >
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input name="mobileNumber" type="text" class="form-control" value="{{ old('mobileNumber') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Landline Number</label>
                                                <input name="landlineNumber" type="text" class="form-control" value="{{ old('landlineNumber') }}">
                                            </div>
                                        </div>
                                        

                                       {{-- LOGIN DETAILS --}}
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Login Details</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Teacher Id</label>
                                                <input name="teacherId" type="text" class="form-control" value="{{ old('teacherId') }}" required>
                                                <x-input-error :messages="$errors->get('teacherId')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" id="password" name="password" class="form-control" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Repeat Password</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        

                                       {{-- Address --}}
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Address</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <select name="region" id="region" class="form-control">
                                                    {{-- <option value="">Select Region</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                            <label for="region">Province</label>
                                            <select name="province" id="province" class="form-control">
                                                {{-- <option value="">Select Province</option> --}}
                                            </select>
                                            </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="region">Municipality</label>
                                                <select name="city" id="city" class="form-control">
                                                    {{-- <option value="">Select City</option> --}}
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="region">Barangay</label>
                                                <select name="barangay" id="barangay" class="form-control">
                                                    {{-- <option value="">Select Baranggay</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" type="text" class="form-control" value="{{ old('address') }}">
                                            </div>
                                        </div>
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
        @include('layouts/footer')
    </div>

    
    {{-- TIMER FOR ALERTS --}}
    <script src="{{ asset('js/myjs/timerAlert.js') }}"></script>
    {{-- AUTO POPULATE ADDRESS FIELDS --}}
    <script src="{{ asset('js/myjs/populateAddress.js') }}"></script>

</body>

</html>
