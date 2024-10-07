<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit Students</title>
</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Students</a></li>
                                <li class="breadcrumb-item active">Edit Students</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('edit-student.update', ['id' => $students->id]) }}">
                                    @csrf
                                    <div class="row">
                                         {{-- Student Information --}}
                                         <div class="col-4">
                                            <div class="form-group">
                                                <img src="{{ asset('storage/images/display-photo/' . $studentPhoto->displayPhoto) }}"
                                                    style="height: 250px">
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <h5 class="form-title"><span>Student Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstName" type="text" class="form-control"
                                                value="{{ $students-> firstName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input name="middleName" type="text" class="form-control"
                                                value="{{ $students-> middleName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastName" type="text" class="form-control"
                                                value="{{ $students-> lastName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input name="suffixName" type="text" class="form-control"
                                                value="{{ $students->suffix}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control">
                                                    <option readonly>Select Gender</option>
                                                    <option value="Female"
                                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Male"
                                                        {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Others"
                                                        {{ old('gender') == 'Others' ? 'selected' : '' }}>Others
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input name="birthday" type="date" class="form-control"
                                                value="{{ $students-> birthday}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="age" type="text" class="form-control"
                                                value="{{ $students-> age}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input name="mobileNumber" type="text" class="form-control"
                                                value="{{ $students-> mobileNumber}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Landline Number</label>
                                                <input name="landlineNumber" type="text" class="form-control"
                                                value="{{ $students-> landlineNumber}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input name="religion" type="text" class="form-control"
                                                value="{{ $students-> religion}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Place of Birth</label>
                                                <input name="birthPlace" type="text" class="form-control"
                                                value="{{ $students-> birthPlace}}">
                                            </div>
                                        </div>


                                        {{-- LOGIN DETAILS --}}
                                        {{-- <div class="col-12 text-center">
                                            <h5 class="form-title"><span>Login Details</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Student Id</label>
                                                <input name="studentId" type="text" class="form-control"
                                                    value="{{ old('studentId') }}" required>
                                                <x-input-error :messages="$errors->get('studentId')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input name="email" type="email" class="form-control"
                                                    value="{{ old('email') }}" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 error-text" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Repeat Password</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control" required>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error-text" />
                                            </div>
                                        </div> --}}

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
                                                <input name="address" type="text" class="form-control" value="{{ $address->address ?? '' }}">
                                            </div>
                                        </div>

                                        {{-- Parent Information --}}
                                        <div class="col-12 text-center">
                                            <h5 class="form-title"><span>Parent Information</span></h5>
                                        </div>

                                        {{-- Mother Details --}}
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Mother Details</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Mother's First Name</label>
                                                <input name="mothersFirstName" type="text" class="form-control"
                                                value="{{ $guardians->mothersFirstName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Mother's Last Name</label>
                                                <input name="mothersLastName" type="text" class="form-control"
                                                value="{{ $guardians->mothersLastName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input name="mothersOccupation" type="text" class="form-control"
                                                value="{{ $guardians->mothersOccupation}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input name="mothersMobile" type="text" class="form-control"
                                                value="{{ $guardians->mothersMobile}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="mothersAge" type="text" class="form-control"
                                                value="{{ $guardians->mothersAge}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="motherAddress" type="text" class="form-control"
                                                value="{{ $guardians-> motherAddress}}">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="sameMotherAddress">
                                                    <label class="form-check-label" for="sameMotherAddress"
                                                        style="font-size: 13px">
                                                        Same as Student Address
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Father Details --}}
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Father Details</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Father's First Name</label>
                                                <input name="fathersFirstName" type="text" class="form-control"
                                                value="{{ $guardians->fathersFirstName}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Father's Last Name</label>
                                                <input name="fathersLastName" type="text" class="form-control"
                                                value="{{ $guardians->fathersLastName}}"
                                                    placeholder="include extension name in Last Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input name="fathersOccupation" type="text" class="form-control"
                                                value="{{ $guardians->fathersOccupation}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input name="fathersMobile" type="text" class="form-control"
                                                value="{{ $guardians->fathersMobile}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="fathersAge" type="text" class="form-control"
                                                value="{{ $guardians->fathersAge}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="fatherAddress" type="text" class="form-control"
                                                value="{{ $guardians-> fatherAddress}}">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="sameFatherAddress">
                                                    <label class="form-check-label" for="sameFatherAddress"
                                                        style="font-size: 13px">
                                                        Same as Student Address
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Last School Attended --}}
                                        <div class="col-12 text-center">
                                            <h5 class="form-title"><span>School Last Attended</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Name of School</label>
                                                <input name="lastSchool" type="text" class="form-control"
                                                value="{{ $lastSchool->school}}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>General Average</label>
                                                <input name="lastSchoolAverage" type="text" class="form-control"
                                                value="{{ $lastSchool->genAverage}}">
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
    </div>

    @include('layouts/footer')

      {{-- AUTO POPULATE ADDRESS FIELDS --}}
      <script>
        fetch("{{ asset('js/philippinesgeo.json') }}")
            .then(response => response.json())
            .then(data => {
                const regionSelect = document.getElementById('region');
                const provinceSelect = document.getElementById('province');
                const citySelect = document.getElementById('city');
                const barangaySelect = document.getElementById('barangay');
                
                // Add default options for region
                const defaultRegionOption = document.createElement('option');
                defaultRegionOption.value = '';
                defaultRegionOption.textContent = 'Select Region';
                regionSelect.appendChild(defaultRegionOption);
    
                // Add default options for province, city, and barangay
                ['province', 'city', 'barangay'].forEach(selectId => {
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = `Select ${selectId.charAt(0).toUpperCase() + selectId.slice(1)}`;
                    document.getElementById(selectId).appendChild(defaultOption);
                });
    
                // Populate regions
                for (const regionName in data) {
                    const option = document.createElement('option');
                    option.value = regionName;
                    option.textContent = regionName;
                    regionSelect.appendChild(option);
                }
                regionSelect.value = "{{ $address-> region}}";

                // Function to populate provinces based on selected region
                function populateProvinces(selectedRegion) {
                    provinceSelect.innerHTML = ''; // Clear previous options
    
                    if (selectedRegion) {
                        const region = data[selectedRegion];
                        if (region) {
                            for (const provinceName in region.province_list) {
                                const option = document.createElement('option');
                                option.value = provinceName;
                                option.textContent = provinceName;
                                provinceSelect.appendChild(option);
                            }
                        }
                    }
                    // Set selected province based on old input
                    provinceSelect.value = "{{ $address-> province}}";
                    // Trigger change event to populate cities
                    provinceSelect.dispatchEvent(new Event('change'));
                }
    
                // Function to populate cities/municipalities based on selected province
                function populateCities(selectedProvince) {
                    citySelect.innerHTML = ''; // Clear previous options
    
                    if (selectedProvince) {
                        const selectedRegion = regionSelect.value;
                        const region = data[selectedRegion];
                        if (region) {
                            const province = region.province_list[selectedProvince];
                            if (province && province.municipality_list) {
                                for (const municipalityName in province.municipality_list) {
                                    const option = document.createElement('option');
                                    option.value = municipalityName;
                                    option.textContent = municipalityName;
                                    citySelect.appendChild(option);
                                }
                            }
                        }
                    }
                    // Set selected city based on old input
                    citySelect.value = "{{ $address-> city}}";
                    // Trigger change event to populate barangays
                    citySelect.dispatchEvent(new Event('change'));
                }
    
                // Function to populate barangays based on selected city
                function populateBarangays(selectedCity) {
                    barangaySelect.innerHTML = ''; // Clear previous options
    
                    if (selectedCity) {
                        const selectedRegion = regionSelect.value;
                        const selectedProvince = provinceSelect.value;
                        const region = data[selectedRegion];
                        if (region) {
                            const province = region.province_list[selectedProvince];
                            if (province && province.municipality_list) {
                                const city = province.municipality_list[selectedCity];
                                if (city && city.barangay_list) {
                                    city.barangay_list.forEach(barangayName => {
                                        const option = document.createElement('option');
                                        option.value = barangayName;
                                        option.textContent = barangayName;
                                        barangaySelect.appendChild(option);
                                    });
                                }
                            }
                        }
                    }
                    // Set selected barangay based on old input
                    barangaySelect.value = "{{ $address-> baranggay}}";
                }
    
                // Event listeners for select elements
                regionSelect.addEventListener('change', () => {
                    const selectedRegion = regionSelect.value;
                    populateProvinces(selectedRegion);
                });
    
                provinceSelect.addEventListener('change', () => {
                    const selectedProvince = provinceSelect.value;
                    populateCities(selectedProvince);
                });
    
                citySelect.addEventListener('change', () => {
                    const selectedCity = citySelect.value;
                    populateBarangays(selectedCity);
                });
    
                // Trigger initial population
                populateProvinces("{{ $address-> region}}");
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    {{-- AUTO POPULATE ADDRESS IF CHECKBOX IS CHECKED --}}
<script>
    // Get the elements
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    const addressInput = document.querySelector('input[name="address"]');

    const motherAddressInput = document.querySelector('input[name="motherAddress"]');
    const sameMotherAddressCheckbox = document.getElementById('sameMotherAddress');

    const fatherAddressInput = document.querySelector('input[name="fatherAddress"]');
    const sameFatherAddressCheckbox = document.getElementById('sameFatherAddress');

    // Add event listener to mother's checkbox
    sameMotherAddressCheckbox.addEventListener('change', function() {
        // Check if checkbox is checked
        if (this.checked) {
            // Get the selected values from the dropdowns
            const provinceValue = provinceSelect.value;
            const cityValue = citySelect.value;
            const barangayValue = barangaySelect.value;
            const addressValue = addressInput.value;

            // Combine values to form the mother's address
            const motherAddressValue = `${provinceValue}, ${cityValue}, ${barangayValue}, ${addressValue}`;

            // Set mother's address value
            motherAddressInput.value = motherAddressValue;
        } else {
            // Clear mother's address value
            motherAddressInput.value = '';
        }
    });

    // Add event listener to father's checkbox
    sameFatherAddressCheckbox.addEventListener('change', function() {
        // Check if checkbox is checked
        if (this.checked) {
            // Get the selected values from the dropdowns
            const provinceValue = provinceSelect.value;
            const cityValue = citySelect.value;
            const barangayValue = barangaySelect.value;
            const addressValue = addressInput.value;

            // Combine values to form the father's address
            const fatherAddressValue = `${provinceValue}, ${cityValue}, ${barangayValue}, ${addressValue}`;

            // Set father's address value
            fatherAddressInput.value = fatherAddressValue;
        } else {
            // Clear father's address value
            fatherAddressInput.value = '';
        }
    });
</script>

</html>
