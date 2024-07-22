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