document.addEventListener("DOMContentLoaded", function () {
    fetch("/api/attendance")
        .then((response) => response.json())
        .then((data) => {
            // Generate labels for the entire month
            const labels = data.map((entry) =>
                new Date(entry.date).toLocaleDateString("en-US", {
                    day: "2-digit",
                    month: "short",
                })
            );
            const attendanceStatus = data.map((entry) => {
                if (entry.status === undefined || entry.status === null) {
                    return 0.5; // Default to middle when there's no status
                }
                return entry.status ? 1 : 0; // 1 for Present, 0 for Absent
            });

            // Create the line chart
            const ctx = document
                .getElementById("attendanceChart")
                .getContext("2d");
            const attendanceChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Attendance",
                            data: attendanceStatus,
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                            fill: false,
                        },
                    ],
                },
                options: {
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: true, // Skip some labels to avoid crowding
                                maxRotation: 45, // Rotate labels for better readability
                                minRotation: 30,
                            },
                        },
                        y: {
                            // beginAtZero: true,
                            min: 0,
                            max: 1,
                            ticks: {
                                stepSize: 0.5, // Use steps of 0.5 to position the line in the middle
                                callback: function (value) {
                                    if (value === 1) {
                                        return "Present";
                                    } else if (value === 0) {
                                        return "Absent";
                                    } else {
                                        return ""; // For middle or in-between values (0.5), no label
                                    }
                                },
                            },
                        },
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    const value = tooltipItem.raw; // Get the value from the tooltip item
                                    if (value === 1) {
                                        return "Present";
                                    } else if (value === 0) {
                                        return "Absent";
                                    } else {
                                        return ""; // Don't show anything for 0.5
                                    }
                                },
                            },
                        },
                    },
                },
            });
        });
});
