document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('absentChart').getContext('2d');
    let absentChart;

    function fetchAbsentReport(filter = 'today') {
        $.ajax({
            url: '/api/absentreport',
            method: 'GET',
            data: { filter: filter },
            success: function(response) {
                const reasons = response.map(item => item.reason);
                const totals = response.map(item => item.total);

                // If the chart already exists, destroy it before creating a new one
                if (absentChart) {
                    absentChart.destroy();
                }

                // Create the pie chart with data labels
                absentChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: reasons,
                        datasets: [{
                            label: 'Absent Reasons',
                            data: totals,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            },
                            datalabels: {
                                color: '#333',
                                font: {
                                    weight: 'bold'
                                },
                                formatter: function(value, context) {
                                    return value;  // Display the value inside the pie slice
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] // Register the datalabels plugin
                });
            },
            error: function(xhr) {
                console.error('Error fetching absent report:', xhr);
            }
        });
    }

    // Fetch the absent report data when the page loads
    fetchAbsentReport();

    // Update chart based on filter selection
    $('#dateFilter').on('change', function() {
        const filter = $(this).val();
        fetchAbsentReport(filter);
    });
});