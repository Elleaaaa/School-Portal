$(document).ready(function() {
    function formatDate(dateStr) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateStr).toLocaleDateString(undefined, options);
    }

    function displayAttendance(month) {
        $.ajax({
            url: "/student-attendance",
            method: "GET",
            data: { month: month },
            success: function(data) {
                const attendanceSummary = $('#attendance-summary');
                attendanceSummary.empty();

                if (data.length === 0) {
                    attendanceSummary.append('<div class="alert alert-warning">No attendance records found for this month.</div>');
                    return;
                }

                data.forEach(record => {
                    const statusClass = record.status === 1 ? 'present' : 'absent';
                    const statusText = record.status === 1 ? 'Present' : 'Absent';
                    attendanceSummary.append(`
                        <div class="list-group-item ${statusClass}">
                            ${formatDate(record.date)} - ${statusText}
                        </div>
                    `);
                });
            }
        });
    }

    const currentMonth = new Date().toISOString().slice(0, 7);
    $('#month-picker').val(currentMonth);
    $('#current-month').text(new Date(currentMonth + '-01').toLocaleDateString(undefined, { year: 'numeric', month: 'long' }));
    displayAttendance(currentMonth);

    $('#month-picker').on('change', function() {
        const selectedMonth = $(this).val();
        $('#current-month').text(new Date(selectedMonth + '-01').toLocaleDateString(undefined, { year: 'numeric', month: 'long' }));
        displayAttendance(selectedMonth);
    });
});