document
    .getElementById("studentId")
    .addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default Enter key behavior
            checkPaymentStatus(); // Call the function to handle the fetch request
        }
    });

function checkPaymentStatus() {
    const studentId = document.getElementById("studentId").value;
    const token = document.querySelector('input[name="_token"]').value;

    fetch("/check-payment-status", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify({ studentId: studentId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (!data.success) {
                // Show SweetAlert2 alert with the message for no payments
                Swal.fire({
                    title: "Warning",
                    text: data.message, // Message about no payments found
                    icon: "warning",
                    confirmButtonText: "OK",
                });
            } else {
                // Check the payment status
                if (data.status === "fully_paid") {
                    Swal.fire({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                } else if (data.status === "not_fully_paid") {
                    Swal.fire({
                        title: "Notice",
                        text: data.message,
                        icon: "info",
                        confirmButtonText: "OK",
                    });
                } else {
                    // Handle unknown status if needed
                    Swal.fire({
                        title: "Info",
                        text: data.message,
                        icon: "info",
                        confirmButtonText: "OK",
                    });
                }
            }
        })

        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                title: "Error",
                text: "An error occurred while checking payment status.",
                icon: "error",
                confirmButtonText: "OK",
            });
        });
}
