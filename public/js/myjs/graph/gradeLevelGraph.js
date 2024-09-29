document.addEventListener('DOMContentLoaded', function() {
    // Fetch grade level data from the API
    fetch('/api/allgradelevels')
        .then(response => response.json())
        .then(gradeLevels => {
            // Count the occurrences of each grade level
            const gradeLevelCounts = {};

            gradeLevels.forEach(gradeLevel => {
                if (gradeLevelCounts[gradeLevel]) {
                    gradeLevelCounts[gradeLevel]++;
                } else {
                    gradeLevelCounts[gradeLevel] = 1;
                }
            });

            // Prepare data for the pie chart
            const labels = Object.keys(gradeLevelCounts);  // Grade levels as labels
            const data = Object.values(gradeLevelCounts);  // Student counts

            // Create the pie chart
            const ctx = document.getElementById('gradeLevelChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels, // The grade levels as labels
                    datasets: [{
                        label: 'Grade Level Distribution',
                        data: data, // Number of students per grade level
                        backgroundColor: [
                            '#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                        ],
                        hoverBackgroundColor: [
                            '#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        // Enable the datalabels plugin
                        datalabels: {
                            color: '#000', // Label color
                            font: {
                                weight: 'bold',
                                size: 16
                            },
                            formatter: function(value, context) {
                                return value; // Display the value
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Register the datalabels plugin
            });
        })
        .catch(error => console.error('Error fetching grade level data:', error));
});