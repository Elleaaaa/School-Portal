<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">

    <style>
        .calendar-container {
            overflow-x: auto; /* Enables horizontal scrolling */
            overflow-y: hidden; /* Prevents vertical scrolling */
        }

        @media (max-width: 768px) {
            .calendar-container {
                display: block; /* Ensures the container takes up the full width */
            }

            /* Ensure the entire FullCalendar, including the header, is scrollable */
            .fc-view, .fc-toolbar {
                min-width: 600px;
                white-space: nowrap; /* Prevents wrapping */
            }
        }
    </style>

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome Admin!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div id="successAlert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failed'))
                    <div id="failedAlert" class="alert alert-failed">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-one w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{$enrolledCount}}</h3>
                                        <h6><a href="{{ route('studentlist.show') }}">Enrolled Students</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-two w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>{{$teachersCount}}</h3>
                                        <h6><a href="{{ route('teacherlist.show') }}">Teachers</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-three w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>30+</h3>
                                        <h6>Department</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-four w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>$505</h3>
                                        <h6>Revenue</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    {{-- <div class="col-auto text-right float-right ml-auto">
                        <a href="add-events.html" class="btn btn-primary"> Add Event <i class="fas fa-plus"></i></a>
                    </div> --}}
                    {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title">Calendar</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="calendar" class="calendar-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts/footer')

         <!-- Modal for adding new event -->
         <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="eventForm" method="POST" action="{{ route('events.store') }}" onsubmit="return validateDateTime()">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="eventName">Event Name</label>
                                <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter Event Name" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="Mandatory">Mandatory</option>
                                    <option value="Voluntary">Voluntary</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_datetime">Start Date and Time</label>
                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
                            </div>
                            <div class="form-group">
                                <label for="end_datetime">End Date and Time</label>
                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitButton">Save Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


            </div>

        </div>

    </div>
    </div>
</div>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/index.global.min.js') }}"></script>
    {{-- TIMER FOR ALERTS --}}
    <script src="{{ asset('js/myjs/timerAlert.js') }}"></script>

    <script src="{{ asset('js/myjs/events.fullcalendar.js') }}"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            display_events();
        });

        function display_events() {
            fetch('/get-events')
                .then(response => response.json())
                .then(response => {
                    console.log("AJAX response: ", response);
                    if (response.data && response.data.length > 0) {
                        var events = response.data.map(item => {
                            if (item.id && item.title && item.start && item.end) {
                                return {
                                    id: item.id,
                                    title: item.title,
                                    start: item.start,
                                    end: item.end,
                                    allDay: item.allDay // Adjust as needed
                                };
                            } else {
                                console.warn("Invalid event data:", item);
                                return null;
                            }
                        }).filter(event => event !== null);
                        console.log("Events Array:", events);
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
                events: events,
                select: function(info) {
                    // var startFormatted = info.startStr;
                    // var endFormatted = info.endStr;
                    var startFormatted = moment(info.startStr).format('YYYY-MM-DD HH:mm');
                    var endFormatted = moment(info.endStr).format('YYYY-MM-DD HH:mm');
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
        </script> --}}

{{-- <script>
    function validateDateTime() {
        const startDateTime = document.getElementById('start_datetime').value;
        const endDateTime = document.getElementById('end_datetime').value;

        if (new Date(startDateTime) >= new Date(endDateTime)) {
            alert('End Date and Time must be greater than Start Date and Time.');
            return false;
        }
        return true;
    }
</script> --}}

</body>


</html>
