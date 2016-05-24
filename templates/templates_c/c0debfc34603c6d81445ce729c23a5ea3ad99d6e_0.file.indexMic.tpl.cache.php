<?php /* Smarty version 3.1.27, created on 2016-05-24 00:24:25
         compiled from "templates\templates\indexMic.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:6730574383198bffb1_60043553%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0debfc34603c6d81445ce729c23a5ea3ad99d6e' => 
    array (
      0 => 'templates\\templates\\indexMic.tpl',
      1 => 1464024507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6730574383198bffb1_60043553',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5743831991b755_32524665',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5743831991b755_32524665')) {
function content_5743831991b755_32524665 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '6730574383198bffb1_60043553';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset='utf-8' />
    <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/fullcalendar.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lang-all.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
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