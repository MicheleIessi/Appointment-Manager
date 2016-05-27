<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
        <link href='View/css/prova.css' rel="stylesheet" />
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/fullcalendar.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lang-all.js'></script>
        <script type="text/javascript" src='JS/JCalendar.js'></script>
        <script type="text/javascript" src="JS/jquery.leanModal.min.js"></script>
        <title>{$title}</title>
    </head>
    <body>
    {$banner}
    <div class ="mainButtons"></div>
    <div class ="main">
        <!-- MAIN CONTENT -->
        <div id='content'>
            {$main_content}
        </div>
        <!-- SIDE CONTENT -->
        <div class="side_content">
            {$right_content}
        </div>
        </div>
    </body>
</html>