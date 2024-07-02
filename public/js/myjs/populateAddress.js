document.addEventListener('DOMContentLoaded', function() {
    fetch("/js/philippinesgeo.json")
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
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
            regionSelect.value = old('region');

            // Function to populate provinces based on selected region
            function populateProvinces(selectedRegion) {
                provinceSelect.innerHTML = ''; // Clear previous options
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Province';
                provinceSelect.appendChild(defaultOption);

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
                provinceSelect.value = old('province');
                provinceSelect.dispatchEvent(new Event('change'));
            }

            // Function to populate cities/municipalities based on selected province
            function populateCities(selectedProvince) {
                citySelect.innerHTML = ''; // Clear previous options
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select City';
                citySelect.appendChild(defaultOption);

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
                citySelect.value = old('city');
                citySelect.dispatchEvent(new Event('change'));
            }

            // Function to populate barangays based on selected city
            function populateBarangays(selectedCity) {
                barangaySelect.innerHTML = ''; // Clear previous options
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Barangay';
                barangaySelect.appendChild(defaultOption);

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
                barangaySelect.value = old('barangay');
            }

            // Event listeners for select elements
            regionSelect.addEventListener('change', () => {
                const selectedRegion = regionSelect.value;
                console.log('Region changed:', selectedRegion); // Debugging
                populateProvinces(selectedRegion);
            });

            provinceSelect.addEventListener('change', () => {
                const selectedProvince = provinceSelect.value;
                console.log('Province changed:', selectedProvince); // Debugging
                populateCities(selectedProvince);
            });

            citySelect.addEventListener('change', () => {
                const selectedCity = citySelect.value;
                console.log('City changed:', selectedCity); // Debugging
                populateBarangays(selectedCity);
            });

            // Trigger initial population
            populateProvinces(old('region'));
        })
        .catch(error => console.error('Error fetching data:', error));
});

// Helper function to get old input values (simulates Blade's old() function)
function old(inputName) {
    const inputElement = document.querySelector(`input[name="${inputName}"]`);
    return inputElement ? inputElement.value : '';
}
