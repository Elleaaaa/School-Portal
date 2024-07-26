document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/attendance')
        .then(response => response.json())
        .then(data => {
            // Generate labels for the entire month
            const labels = data.map(entry => new Date(entry.date).toLocaleDateString('en-US', { day: '2-digit', month: 'short' }));
            const attendanceStatus = data.map(entry => entry.status ? 1 : 0);

            // Create the line chart
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const attendanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Attendance',
                        data: attendanceStatus,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: true, // Skip some labels to avoid crowding
                                maxRotation: 45, // Rotate labels for better readability
                                minRotation: 30
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function (value) {
                                    return value === 1 ? 'Present' : 'Absent';
                                }
                            }
                        }
                    }
                }
            });
        });
});