document.addEventListener('DOMContentLoaded', function() {
    display_events();
});

function display_events() {
    fetch('/get-events')
        .then(response => response.json())
        .then(response => {
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
        editable: false, // Disable event dragging/resizing
        droppable: false, // Disable dragging from external sources
        selectable: false, // Disable selecting date ranges
        timeZone: 'local', // Ensure this matches your application's timezone
        events: events.map(event => ({
            ...event,
            extendedProps: {
                category: event.category || ''
            }
        })),
        eventContent: function(arg) {
            if (arg.event) {
                var title = arg.event.title || 'Untitled';
                return { html: `<div class="fc-time">${title}</div>` };
            } else {
                console.warn("Invalid event:", arg.event);
            }
        }
    });

    calendar.render();
}
