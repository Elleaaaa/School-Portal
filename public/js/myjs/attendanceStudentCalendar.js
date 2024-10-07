 // Declare calendar variable in the global scope
 var calendar;
    
 // Function to display attendance
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

             const attendanceMap = {};
             data.forEach(record => {
                 const date = formatDate(record.date);
                 attendanceMap[date] = record.status === 1 ? 'present' : 'absent'; // Adjusted for 0 and 1

                 const statusClass = record.status === 1 ? 'present' : 'absent';
                 const statusText = record.status === 1 ? 'Present' : 'Absent';
                 attendanceSummary.append(`
                     <div class="list-group-item ${statusClass}">
                         ${date} - ${statusText}
                     </div>
                 `);
             });

             // Update calendar with attendance colors
             updateCalendarColors(attendanceMap);
         }
     });
 }

 // Function to update calendar colors based on attendance
 function updateCalendarColors(attendanceMap) {
     // Clear existing events to redraw
     const currentEvents = calendar.getEvents(); // Get current events
     currentEvents.forEach(event => {
         event.remove(); // Remove each event
     });

     // Loop through attendanceMap and add colored events
     for (const date in attendanceMap) {
         const status = attendanceMap[date];
         const event = {
             start: date,
             display: 'background', // This makes the event fill the entire day box
             backgroundColor: status === 'present' ? 'green' : 'red', // Set color based on attendance status
         };
         calendar.addEvent(event);
     }
 }

 // Function to format date as 'YYYY-MM-DD'
 function formatDate(date) {
     return moment(date).format('YYYY-MM-DD');
 }

 document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('calendar');

     // Initialize the calendar
     calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'dayGridMonth',
         headerToolbar: {
             left: 'prev,next today',
             center: 'title',
             right: 'dayGridMonth,timeGridWeek,timeGridDay'
         },
         events: [], // Initial empty event list

         // This event fires when the visible date range changes (e.g., when navigating between months)
         datesSet: function() {
             const month = calendar.getDate().toISOString().slice(0, 7); // Get the current month in 'YYYY-MM'
             displayAttendance(month); // Call the function to display attendance
         }
     });

     calendar.render(); // Render the calendar
     const month = calendar.getDate().toISOString().slice(0, 7); // Get the current month
     displayAttendance(month); // Call the function to fetch and display attendance
 });