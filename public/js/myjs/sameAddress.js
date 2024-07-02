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