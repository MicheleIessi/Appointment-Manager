$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        droppable: true,    // this allows things to be dropped onto the calendar
        drop: function() {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },


        firstDay: 1,
        defaultView: 'agendaWeek',

        views: {
            agenda: {
                allDaySlot: false,
                slotDuration: '00:10:00',
                slotLabelInterval: '01:00:00',
                slotEventOverlap: false
            }
        },

        nowIndicator: true,
        lang: 'it',
        timeFormat: 'H:mm',
        columnFormat: 'dddd D',
        titleFormat: 'D MMMM YYYY',
        displayEventTime: true,
        displayEventEnd: true,
        eventOverlap: false,
        defaultTimedEventDuration: '01:00:00',
        forceEventDuration: true,
        eventDurationEditable: false,
        dragOpacity: .75,
        events: {
            url: 'Control/CProcessaCalendar.php',
            type: 'POST',
            data: {
                type: 'fetch'
            },
            error: function() {
                alert('there was an error while fetching events!');
            }
        }
    });
});
