$(document).ready(function() {

    /* RENDE DRAGGABILI GLI EVENTI */

    $('#external-events .fc-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 10  //  original position after the drag
        });

    });

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        eventRender: function(event, element) {
            element.append( "<span class='closeon'>X</span>" );
            element.find(".closeon").click(function() {
                $('#calendar').fullCalendar('removeEvents',event._id);
            });
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
