document.addEventListener('DOMContentLoaded', function() {
    fetchScholarTypes();

    // Add event listener to dropdown to fetch discount based on scholar type
    document.getElementById('scholarTypeDropdown').addEventListener('change', function() {
        let scholarType = this.value;
        if (scholarType) {
            fetchDiscountByScholarType(scholarType);
        } else {
            document.getElementById('scholarDiscount').value = ''; // Clear if no type is selected
        }
    });
});

function fetchScholarTypes() {
    fetch('/fetch-discountType')
        .then(response => response.json())
        .then(data => {
            let dropdown = document.getElementById('scholarTypeDropdown');

            if (!data.error) {
                data.forEach(function(type) {
                    let option = document.createElement('option');
                    option.value = type;
                    option.text = type;
                    dropdown.add(option);
                });
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => console.error('Error fetching scholar types:', error));
}

function fetchDiscountByScholarType(scholarType) {
    const encodedType = encodeURIComponent(scholarType); // Encode the scholar type for URL
    fetch(`/get-discount/${encodedType}`)
        .then(response => response.json())
        .then(data => {
            let discountInput = document.getElementById('scholarDiscount');

            if (!data.error) {
                if (data.amount && data.percentage) {
                    // If both amount and percentage are available, you can display both.
                    discountInput.value = `Amount: ${data.amount}, Percentage: ${data.percentage}%`;
                } else if (data.amount) {
                    // If only amount is available, display it.
                    discountInput.value = `${data.amount}`;
                } else if (data.percentage) {
                    // If only percentage is available, display it.
                    discountInput.value = `${data.percentage}`;
                } else {
                    discountInput.value = 'No Discount Available'; // If neither is available, clear the field.
                }
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => console.error('Error fetching discount:', error));
}