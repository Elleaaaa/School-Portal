document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/payments')
        .then(response => response.json())
        .then(data => {
            // Create the line chart
            const ctx = document.getElementById('paymentsChart').getContext('2d');
            const paymentsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.months,
                    datasets: [
                        {
                            label: 'Amount Paid',
                            data: data.amountPaid,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Amount Left',
                            data: data.amountLeft,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            fill: false
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: true,
                                maxRotation: 45,
                                minRotation: 30
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount'
                            }
                        }
                    }
                }
            });
        });
});