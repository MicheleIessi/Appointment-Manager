<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>prova</title>
        <link rel="stylesheet" type="text/css" href="css/jquery.weekcalendar.css" />
        <script type="text/javascript" src="JS/jquery.min.js"></script>
        <script type="text/javascript" src="JS/jquery-ui.js"></script>
        <script type="text/javascript" src="JS/jquery.weekcalendar.js"></script>
        <script type="text/javascript" src="JS/JIndex.js"></script>
    </head>
    <body>
    <?php

        require_once('includes/autoload.inc.php');



        $age = new EAgenda(array(),30);
        $giorniDisponibile=array(
            'lun'=>'00:00-1:00,14:00-18:00',
            'mar'=>'00:00-8:00',
            'mer'=>'07:00-15:00',
            'gio'=>''
        );
        $age->setOrari($giorniDisponibile);





    ?>

    </body>
</html>

