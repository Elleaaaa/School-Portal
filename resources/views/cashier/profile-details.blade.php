<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>My Profile</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
       
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile-cashier.update', ['cashierId' => $cashier->cashierId]) }}" enctype="multipart/form-data">
                                 @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Personal Information</span></h5>
                                        </div>
                                        {{-- PERSONAL Information --}}
                                        <div class="col-4">
                                            <div class="form-group">
                                                <img src="{{ asset('storage/images/display-photo/' . $user->displayPhoto) }}"  style="height: 250px">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Change Photo</label>
                                                <input name="displayPhoto" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstName" type="text" class="form-control" value="{{ $cashier->firstName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input name="middleName" type="text" class="form-control"value="{{ $cashier->middleName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastName" type="text" class="form-control" value="{{ $cashier->lastName ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Suffix Name</label>
                                                <input name="suffixName" type="text" class="form-control"
                                                    placeholder="Jr, Sr, III, etc" value="{{ $cashier->suffix ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input readonly name="studentId" type="text" class="form-control" value="{{ Auth::user()->studentId }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control">
                                                    <option readonly>Select Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male" >Male</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input name="birthday" type="date" class="form-control" value="{{ $cashier->birthday ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="age" type="text" class="form-control" value="{{ $cashier->age ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input name="mobileNumber" type="text" class="form-control" value="{{ $cashier->mobileNumber ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Landline Number</label>
                                                <input name="landlineNumber" type="text" class="form-control" value="{{ $cashier->landlineNumber ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input name="religion" type="text" class="form-control" value="{{ $cashier->religion ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Place of Birth</label>
                                                <input name="birthPlace" type="text" class="form-control" value="{{ $cashier->placeOfBirth ?? '' }}">
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
                                            <label for="province">Province</label>
                                            <select name="province" id="province" class="form-control">
                                                {{-- <option value="">Select Province</option> --}}
                                            </select>
                                            </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="city">Municipality</label>
                                                <select name="city" id="city" class="form-control">
                                                    {{-- <option value="">Select City</option> --}}
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="barangay">Barangay</label>
                                                <select name="barangay" id="barangay" class="form-control">
                                                    {{-- <option value="">Select Baranggay</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" type="text" class="form-control">
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
    
    <script src="{{ asset('js/philippinesgeo.json') }}"></script>
    {{-- POPULATES THE ADDRESS FIELDS --}}
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
    
                // Iterate over each region
                for (const regionName in data) {
                    const option = document.createElement('option');
                    option.value = regionName;
                    option.textContent = regionName;
                    regionSelect.appendChild(option);
                }
    
                // Function to populate provinces based on selected region
                function populateProvinces(selectedRegion) {
                    provinceSelect.innerHTML = ''; // Clear previous options
    
                    if (selectedRegion) {
                       // Add default option for Province
                       const defaultProvinceOption = document.createElement('option');
                       defaultProvinceOption.value = '';
                       defaultProvinceOption.textContent = 'Select Province';
                       provinceSelect.appendChild(defaultProvinceOption);
  
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
                }
    
                // Function to populate cities/municipalities based on selected province
                function populateCities(selectedProvince) {
                    citySelect.innerHTML = ''; // Clear previous options
    
                    if (selectedProvince) {
                       citySelect.innerHTML = ''; // Clear previous options
                       
                       // Add default option for city
                       const defaultCityOption = document.createElement('option');
                       defaultCityOption.value = '';
                       defaultCityOption.textContent = 'Select City';
                       citySelect.appendChild(defaultCityOption);
  
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
  
                }
    
                // Function to populate barangays based on selected city
                function populateBarangays(selectedCity) {
                    barangaySelect.innerHTML = ''; // Clear previous options
    
                    if (selectedCity) {
  
                       // Add default option for barangay
                       const defaultBarangayOption = document.createElement('option');
                       defaultBarangayOption.value = '';
                       defaultBarangayOption.textContent = 'Select Barangay';
                       barangaySelect.appendChild(defaultBarangayOption);
  
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
                }
    
                // Event listeners for select elements
                regionSelect.addEventListener('change', () => {
                    const selectedRegion = regionSelect.value;
                    populateProvinces(selectedRegion);
                    populateCities(null); // Clear city dropdown
                    populateBarangays(null); // Clear barangay dropdown
                });
    
                provinceSelect.addEventListener('change', () => {
                    const selectedProvince = provinceSelect.value;
                    populateCities(selectedProvince);
                    populateBarangays(null); // Clear barangay dropdown
                });
    
                citySelect.addEventListener('change', () => {
                    const selectedCity = citySelect.value;
                    populateBarangays(selectedCity);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

</body>

</html>
