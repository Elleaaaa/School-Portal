document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/allattendance')
        .then(response => response.json())
        .then(data => {
            // Process the data
            createChart(data);
        })
        .catch(error => console.error('Error fetching data:', error));
});

function createChart(data) {
    const labels = [];
    const presentCounts = [];
    const absentCounts = [];
    
    data.forEach(item => {
        labels.push(item.date);
        presentCounts.push(item.present);
        absentCounts.push(item.absent);
    });

    // Create the chart with the processed data
    renderChart(labels, presentCounts, absentCounts);
}

function renderChart(labels, presentCounts, absentCounts) {
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Present',
                    data: presentCounts,
                    borderColor: 'green',
                    backgroundColor: 'rgba(0, 255, 0, 0.1)',
                    fill: true,
                },
                {
                    label: 'Absent',
                    data: absentCounts,
                    borderColor: 'red',
                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                    fill: true,
                },
            ],
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Attendances',
                    },
                    beginAtZero: true,
                },
            },
        },
    });
}