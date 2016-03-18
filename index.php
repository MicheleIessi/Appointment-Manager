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
    </head>
    <body>
        <?php
<<<<<<< HEAD
        require_once 'includes/autoload.inc.php';
        require_once 'includes/config.inc.php';
        require('lib/smarty/Smarty.class.php');
        display('index_default.tpl');
=======
            require_once 'includes/autoload.inc.php';
            $ser = new FServizio();
            $eser = $ser->caricaServizioDaDb("Visita generica");
            $eapp = new EAppuntamento(date('Y-m-d'),"00:00",$eser,"123456","456789");
            $app = new FAppuntamento();
            $app->inserisciAppuntamento($eapp);
>>>>>>> 7b67295ee6869ba739ae6fbcf06e57009f156c98
        ?>
    </body>
</html>

