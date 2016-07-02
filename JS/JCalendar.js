$(document).ready(function() {

    /* RENDE DRAGGABILI GLI EVENTI */


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
        eventConstraint: {
            start: moment().format('YYYY-MM-DD[T]H:mm:ss'),
            end: '2100-01-01' // hard coded goodness unfortunately
        },

        firstDay: 0,
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
        timeFormat: 'H:mm:ss',
        columnFormat: 'dddd D',
        titleFormat: 'D MMMM YYYY',
        displayEventTime: true,
        displayEventEnd: true,
        eventOverlap: false,
        defaultTimedEventDuration: '00:10:00',
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
        },
        eventReceive: function(event) {
            var title = event.title;
            var padding = "00";
            var anno = event.start._i[0];
            var mese = event.start._i[1]+1;
            var meseFix = (padding+mese).slice(-padding.length);
            var giorno = event.start._i[2];
            var giornoFix = (padding+giorno).slice(-padding.length);
            var orePre = event.start._i[3];
            var minPre = event.start._i[4];
            var secPre = event.start._i[5];
            var oreFix = (padding+orePre).slice(-padding.length);
            var minFix = (padding+minPre).slice(-padding.length);
            var secFix = (padding+secPre).slice(-padding.length);

            var data = anno+'-'+meseFix+'-'+giornoFix;
            var ora = oreFix+':'+minFix+':'+secFix;
            var start = data+'T'+ora;

            var decisione = confirm('Sei sicuro di voler effettuare la prenotazione per '+title+'?');
            if ( decisione == true) { // aggiungo l'appuntamento al database
                $.ajax({
                    url: 'Control/CProcessaCalendar.php',
                    type: 'POST',
                    data: {
                        type: 'new',
                        servizio: title,
                        orarioInizio: start
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.stato == 'successo') {
                            document.location.reload(true);
                        }
                        else if (response.stato == 'errore') {
                            $('#calendar').fullCalendar('removeEvents',event._id);
                            alert(response.messaggio);
                        }
                        console.log(response);
                    },
                    error: function (e) {
                        alert('ERRORE:'+e.responseText);
                    }
                });

            }
            else
                $('#calendar').fullCalendar('removeEvents',event._id);
        }
    });

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

});
