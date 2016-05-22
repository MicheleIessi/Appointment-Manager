<?php /* Smarty version 3.1.27, created on 2016-05-22 21:07:37
         compiled from "E:\DocumentRoot\appointment-manager\templates\templates\indexMic.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1081157420379acf2d9_81457921%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44ba8e20cba4baa178e0c6d4b6c26432cc00ff3e' => 
    array (
      0 => 'E:\\DocumentRoot\\appointment-manager\\templates\\templates\\indexMic.tpl',
      1 => 1463937755,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1081157420379acf2d9_81457921',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57420379b33d09_38455830',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57420379b33d09_38455830')) {
function content_57420379b33d09_38455830 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1081157420379acf2d9_81457921';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset='utf-8' />
    <link href='../../JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
    <link href='../../JS/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />
    <?php echo '<script'; ?>
 src='../../JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='../../JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='../../JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='../../JS/fullcalendar-2.6.1/fullcalendar.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='../../JS/fullcalendar-2.6.1/lang-all.js'><?php echo '</script'; ?>
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