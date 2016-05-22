<?php
/*%%SmartyHeaderCode:9564574207c5527850_02190608%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0debfc34603c6d81445ce729c23a5ea3ad99d6e' => 
    array (
      0 => 'templates\\templates\\indexMic.tpl',
      1 => 1463945156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9564574207c5527850_02190608',
  'tpl_function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_574207c55cbba6_10090656',
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_574207c55cbba6_10090656')) {
function content_574207c55cbba6_10090656 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset='utf-8' />
    <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
    <link href='JS/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='JS/fullcalendar-2.6.1/lib/moment.min.js'></script>
    <script src='JS/fullcalendar-2.6.1/lib/jquery.min.js'></script>
    <script src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'></script>
    <script src='JS/fullcalendar-2.6.1/fullcalendar.min.js'></script>
    <script src='JS/fullcalendar-2.6.1/lang-all.js'></script>
    <script>
        $(document).ready(function() {
            var professionista =
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
                                type: 'fetch',
                                id: 1
                            },
                            error: function() {
                                alert('there was an error while fetching events!');
                            }
                        }

                    });
        })
    </script>
</head>
<body>
<div id='calendar'></div>
<div id='external-events'>
    <h4>Draggable Events</h4>
    <div class='fc-event'>New Event</div>
</div>


</body>
</html><?php }
}
?>