(function($) {
    "use strict";

    var CalendarApp = function() {
        this.$calendar = $('#calendar');
        this.$calendarObj = null;
        this.$modal = $('#addEventModal');
    };

    /* Initializing */
    CalendarApp.prototype.init = function() {
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            defaultView: 'month',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,list'
            },
            editable: true,
            droppable: true,
            eventLimit: true,
            selectable: true,
            select: function(start, end, allDay) {
                $this.$modal.find("input[name='start_date']").val(moment(start).format('YYYY-MM-DD'));
                $this.$modal.find("input[name='end_date']").val(moment(end).format('YYYY-MM-DD'));
                $this.$modal.modal('show');
            }
        });
    };

    // Initialize CalendarApp
    $.CalendarApp = new CalendarApp();
    $.CalendarApp.Constructor = CalendarApp;

    // When document is ready, initialize CalendarApp
    $(document).ready(function() {
        $.CalendarApp.init();
    });
})(window.jQuery);
