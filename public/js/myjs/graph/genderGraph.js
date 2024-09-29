document.addEventListener('DOMContentLoaded', function() {
    // Fetch gender data from the API
    fetch('/api/allgenders')
        .then(response => response.json())
        .then(genders => {
            // Count male and female genders
            const genderCounts = {
                male: 0,
                female: 0
            };

            // Loop through the genders and count them
            genders.forEach(gender => {
                if (gender === 'Male') {
                    genderCounts.male++;
                } else if (gender === 'Female') {
                    genderCounts.female++;
                }
            });

            // Create the pie chart
            const ctx = document.getElementById('genderChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        label: 'Gender Distribution',
                        data: [genderCounts.male, genderCounts.female],
                        backgroundColor: ['#36A2EB', '#FF6384'],
                        hoverBackgroundColor: ['#36A2EB', '#FF6384']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
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
        .catch(error => console.error('Error fetching gender data:', error));
});