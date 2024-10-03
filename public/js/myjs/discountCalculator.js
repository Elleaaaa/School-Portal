
// ISSUE!!!!
// amountDiscount is not changing when amount is changed

$(document).ready(function () {
    // Change event for feeType dropdown
    $("#feeType").change(function () {
        var feeType = $(this).val();
        var gradeLevel = $(this).find(":selected").data("grade");
        var classType = $(this).find(":selected").data("class");

        if (feeType) {
            $.ajax({
                url: "/fees/amount",
                type: "GET",
                data: {
                    feeName: feeType,
                    gradeLevel: gradeLevel,
                    classType: classType,
                },
                dataType: "json",
                success: function (response) {
                    $("#amount").val(response.amount);

                    // Call calculateDiscount() after updating the amount
                    calculateDiscount();
                },
                error: function (xhr, status, error) {
                    console.error(error); // Log the error for debugging
                    $("#amount").val(""); // Clear the amount field on error
                },
            });
        } else {
            $("#amount").val(""); // Clear amount if no fee type selected
        }
    });

    // Change event for studentId input
    $("#studentId").on("input", function () {
        var studentId = $(this).val();

        if (studentId) {
            $.ajax({
                url: "/get-discount", // Route for fetching discount
                type: "GET",
                data: {
                    studentId: studentId,
                },
                success: function (response) {
                    // Set the discount and discountAmount fields
                    $("#discount").val(response.discountPercentage);
                    $("#discountAmount").val(response.discountAmount);

                    // Recalculate discount when a new studentId is input
                    calculateDiscount();
                },
            });
        } else {
            // Reset both fields if no studentId is entered
            $("#discount").val(0);
            $("#discountAmount").val(0);
        }
    });

    // Calculate discount function
    function calculateDiscount() {
        var originalPrice = parseFloat($("#amount").val()) || 0;
        var discountPercentage = parseFloat($("#discount").val()) || 0;
        var discountAmount = parseFloat($("#discountAmount").val()) || 0;

        var discountedPrice;

        // Calculate discount amount based on percentage
        if (discountAmount === 0) {
            discountAmount = (originalPrice * discountPercentage) / 100;
            $("#discountAmount").val(discountAmount.toFixed(2)); // Update discountAmount field
        }

        // Calculate discounted price
        discountedPrice = originalPrice - discountAmount;

        // Update the discountedPrice field with the final discounted price
        $("#discountedPrice").val(discountedPrice.toFixed(2));
    }

    // Ensure calculateDiscount is called when needed
    $("#amount, #discount").on("change", function() {
        calculateDiscount(); // Recalculate discount values
    });

    $("#discountAmount").on("change", function() {
        // If user manually inputs discountAmount, recalculate the discounted price
        var originalPrice = parseFloat($("#amount").val()) || 0;
        var discountAmount = parseFloat($("#discountAmount").val()) || 0;
        var discountedPrice = originalPrice - discountAmount;
        $("#discountedPrice").val(discountedPrice.toFixed(2));
    });

    // Initial calculation when the page loads
    calculateDiscount();
});
