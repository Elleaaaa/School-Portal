document.addEventListener("DOMContentLoaded", function() {
    // Fetch data using AJAX
    fetch('/api/gradelevels')
        .then(response => response.json())
        .then(data => {
            // Prepare labels and data for the pie chart
            const gradeLevels = data.map(item => item.gradeLevel);
            const totals = data.map(item => item.total);

            // Create the pie chart
            const ctx = document.getElementById('gradeLevelChart').getContext('2d');
            const gradeLevelChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: gradeLevels,
                    datasets: [{
                        label: 'Number of Students',
                        data: totals,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        // Enable the data labels
                        datalabels: {
                            formatter: (value, context) => {
                                return value; // Display the value
                            },
                            color: '#000', // Label color
                            font: {
                                weight: 'bold',
                                size: 16
                            },
                        }
                    }
                },
                plugins: [ChartDataLabels] // Register the data labels plugin
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});