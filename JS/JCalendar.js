$(document).ready(function() {
    $('#loadingGif').hide();
    $('.cestinoNascosto').hide();
    $('#mostraCestino').click(function() {
        $('.cestinoNascosto').show();
        $('#mostraCestino').hide();
        var dettagli = $('#dettagli');
        dettagli.text('Trascina un appuntamento sul cestino per eliminarlo');
        dettagli.css('color','cornflowerblue');
    });
    $('#fineModifica').click(function() {
        $('.cestinoNascosto').hide();
        $('#mostraCestino').show();
        $('#dettagli').text("");
    });

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        droppable: true,    // this allows things to be dropped onto the calendar
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
                        var dettagli = $('#dettagli');
                        if(response.stato == 'successo') {
                            dettagli.css('color','green');
                            dettagli.text(response.messaggio);
                            window.setTimeout(function(){document.location.reload()},3000)
                        }
                        else if (response.stato == 'errore') {
                            $('#calendar').fullCalendar('removeEvents',event._id);
                            dettagli.css('color','red');
                            dettagli.text(response.messaggio);
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
        },
        eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
            var dettagli = $('#dettagli');
            if(!isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
                dettagli.css('color', 'red');
                dettagli.text('Non si possono modificare appuntamenti già presi. Cancellalo e riesegui la prenotazione.');
                revertFunc();
            }
        },
        eventDragStop: function(event,jsEvent) {
            var trashEl = $('#calendarTrash');
            var ofs = trashEl.offset();
            var x1 = ofs.left;
            var x2 = ofs.left + trashEl.outerWidth(true);
            var y1 = ofs.top;
            var y2 = ofs.top + trashEl.outerHeight(true);
            var idApp = event.id;
            if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 && jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {
                var decisione = confirm('Sei sicuro di voler annullare questo appuntamento?');
                if(decisione) {
                    var motivazione = prompt("Inserire la motivazione:","Nessuna motivazione");
                    var dettagli = $('#dettagli');
                    dettagli.text("");
                    $('#loadingGif').show();
                    $.ajax({
                        url: 'Control/CProcessaCalendar.php',
                        type: 'POST',
                        data: {
                            idApp: idApp,
                            type: 'delete',
                            motivo: motivazione
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.stato == 'successo') {
                                var dettagli = $('#dettagli');
                                $('#loadingGif').hide();
                                dettagli.text(response.messaggio);
                                dettagli.css('color','green');
                                $('#calendar').fullCalendar('removeEvents', event._id);
                            }
                            else if (response.stato == 'errore') {
                                alert(response.messaggio);
                            }
                        },
                        error: function (e) {
                            alert('ERRORE:' + e.responseText);
                        }

                    });
                }
            }
        }


    });
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

    $('#cestino').droppable({
        tolerance: 'pointer',
        accept: '#calendar .fc-event',
        drop: function(event, ui) {
            alert('droppato sul cestino');
        }
    });
});


var isEventOverDiv = function(x, y) {

    var cestino = $('#calendarTrash');
    var offset = cestino.offset();
    offset.right = cestino.width() + offset.left;
    offset.bottom = cestino.height() + offset.top;

    // Compare
    if (x >= offset.left && y >= offset.top && x <= offset.right && y <= offset.bottom) {
        return true;
    }
    return false;
};
