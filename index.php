<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset='utf-8' />
        <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
        <link href='JS/fullcalendar-2.6.1//fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='JS/fullcalendar-2.6.1/lib/moment.min.js'></script>
        <script src='JS/fullcalendar-2.6.1/lib/jquery.min.js'></script>
        <script src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'></script>
        <script src='JS/fullcalendar-2.6.1/fullcalendar.min.js'></script>
        <script src='JS/fullcalendar-2.6.1/lang-all.js'></script>
        <script>

            $(document).ready(function() {


                    /* initialize the external events
                    -----------------------------------------------------------------*/

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
                                    revertDuration: 0  //  original position after the drag
                            });

                    });


                    /* initialize the calendar
                    -----------------------------------------------------------------*/

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
                            columnFormat: 'D dddd',
                            titleFormat: 'D MMMM YYYY',
                            displayEventTime: true,
                            displayEventEnd: true,
                            eventOverlap: false,
                            defaultTimedEventDuration: '02:00:00',
                            forceEventDuration: true,
                            /*  
        ---------------->   eventDataTransform da rivedere
        ---------------->   vedere backgroundEvents ed eventConstraint per fissare gli orari disponibili 
                            */
                            eventDurationEditable: false,
                            dragOpacity: .75,
                            
                            eventSources: [
                            
                                {   // array di eventi; forse meglio usare json
                                    events: [
                                        
                                        {
                                            id:"OrarioLavoro",
                                            start: '08:00',
                                            end: '20:00',
                                            dow: [1,2,3,4,5],
                                            rendering: 'background'
                                        }
                                        
                                    ],
                                    
                                    // opzioni:
                                    editable: false
                                }
                                
                            // any other event sources...
                            ]
                            
                            
                            
                    });


            });

        </script>
        <style>

            body {
                    margin-top: 40px;
                    text-align: center;
                    font-size: 14px;
                    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            }

            #wrap {
                    width: 1100px;
                    margin: 0 auto;
            }

            #external-events {
                    float: left;
                    width: 150px;
                    padding: 0 10px;
                    border: 1px solid #ccc;
                    background: #eee;
                    text-align: left;
            }

            #external-events h4 {
                    font-size: 16px;
                    margin-top: 0;
                    padding-top: 1em;
            }

            #external-events .fc-event {
                    margin: 10px 0;
                    cursor: pointer;
                    padding-left: 5px;
            }

            #external-events p {
                    margin: 1.5em 0;
                    font-size: 11px;
                    color: #666;
                    
            }

            #external-events p input {
                    margin: 0;
                    vertical-align: middle;
            }
            #calendar {
                    float: right;
                    width: 900px;
            }

            </style>

    </head>
    <body>
	<div id='wrap'>

		<div id='external-events'>
			<h4>Draggable Events</h4>
                        <!-- In seguito qui andrà inserito uno script che aggiunge dinamicamente gli eventi
                             offerti dal professionista con le loro rispettive durate -->
                        <div class='fc-event' data-duration='02:00'>My Event 1</div>
			<div class='fc-event' data-duration='02:00'>My Event 2</div>
			<div class='fc-event' data-duration='02:00'>My Event 3</div>
			<div class='fc-event' data-duration='02:00'>My Event 4</div>
			<div class='fc-event' data-duration='02:00'>My Event 5</div>
			<p>
				<input type='checkbox' id='drop-remove' />
				<label for='drop-remove'>remove after drop</label>
			</p>
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

	</div>
    </body>
</html>