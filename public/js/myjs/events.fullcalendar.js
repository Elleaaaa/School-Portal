document.addEventListener('DOMContentLoaded', function() {
    display_events();
});

function display_events() {
    fetch('/get-events')
        .then(response => response.json())
        .then(response => {
            // console.log("AJAX response: ", response); // for debugging purpose
            if (response.data && response.data.length > 0) {
                var events = response.data.map(item => {
                    if (item.id && item.title && item.start && item.end) {
                        return {
                            id: item.id,
                            title: item.title,
                            start: item.start,
                            end: item.end,
                            category: item.category,
                            allDay: item.allDay // Adjust as needed
                        };
                    } else {
                        console.warn("Invalid event data:", item);
                        return null;
                    }
                }).filter(event => event !== null);
                // console.log("Events Array:", events); // for debugging purpose
                initialize_calendar(events);
            } else {
                console.warn("No event data received or events array is empty.");
                initialize_calendar([]);
            }
        })
        .catch(error => {
            console.error("Error fetching events: ", error);
            initialize_calendar([]);
        });
}

function initialize_calendar(events) {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        views: {
            timeGrid: {
                slotDuration: '00:30:00',
                scrollTime: '07:00:00',
                validRange: {
                    start: '07:00:00',
                    end: '19:00:00'
                }
            }
        },
        editable: false,
        droppable: true,
        dayMaxEvents: true, // Replaces eventLimit
        selectable: true,
        timeZone: 'local', // Ensure this matches your application's timezone
        events: events.map(event => ({
            ...event,
            extendedProps: {
                category: event.category || ''
            }
        })),
        select: function(info) {
            clearModalFields(); // Clear the fields first
            var startFormatted = moment(info.startStr).format('YYYY-MM-DD HH:mm'); // formatted the info.startStr
            var endFormatted = moment(info.endStr).format('YYYY-MM-DD HH:mm'); // formatted the info.endStr
            $('#addEventModalLabel').text("Add Event");
            $('#addEventModal').find("input[name='start_datetime']").val(startFormatted);
            $('#addEventModal').find("input[name='end_datetime']").val(endFormatted);
            $('#addEventModal').modal('show');
        },
        eventClick: function(info) {
            var event = info.event;
            var startFormatted = moment(event.startStr).format('YYYY-MM-DD HH:mm');
            var endFormatted = moment(event.endStr).format('YYYY-MM-DD HH:mm');
            $('#addEventModalLabel').text("Update Event");
            $('#addEventModal').find("input[name='eventName']").val(event.title);
            $('#addEventModal').find("input[name='start_datetime']").val(startFormatted);
            $('#addEventModal').find("input[name='end_datetime']").val(endFormatted);
            // Assume you store category in the extendedProps
            $('#addEventModal').find("select[name='category']").val(event.extendedProps.category);
            $('#addEventModal').modal('show');
            // Modify the form's action for updating the event
            $('form').attr('action', '/update-event/' + event.id);
        },
        eventContent: function(arg) {
            if (arg.event) {
                var startTime = arg.event.start ? moment(arg.event.start).format('HH:mm') : '';
                var endTime = arg.event.end ? moment(arg.event.end).format('HH:mm') : '';
                var title = arg.event.title || 'Untitled';
                if (startTime && endTime) {
                    // return { html: `<div class="fc-time">${startTime} - ${endTime} - ${title} </div>` };
                    return { html: `<div class="fc-time">${title} </div>` };
                }
            } else {
                console.warn("Invalid event:", arg.event);
            }
        }
    });

    calendar.render();
}

function clearModalFields() {
    $('#addEventModal').find("input[name='eventName']").val('');
    $('#addEventModal').find("input[name='start_datetime']").val('');
    $('#addEventModal').find("input[name='end_datetime']").val('');
    $('#addEventModal').find("select[name='category']").val('');
    // Reset the form action to the default add event action
    $('form').attr('action', '/add-event');
}

function validateDateTime() {
    const startDateTime = document.getElementById('start_datetime').value;
    const endDateTime = document.getElementById('end_datetime').value;

    if (new Date(startDateTime) >= new Date(endDateTime)) {
        alert('End Date and Time must be greater than Start Date and Time.');
        return false;
    }
    return true;
}