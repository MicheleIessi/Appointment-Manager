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
            require_once 'includes/autoload.inc.php';
            $ser = new FServizio();
            $eser = $ser->caricaServizioDaDb("Visita generica");
            $eapp = new EAppuntamento(date('Y-m-d'),"00:00",$eser,"123456","456789");
            $app = new FAppuntamento();
            $app->inserisciAppuntamento($eapp);
            $app->cancellaAppuntamento($eapp);
        ?>
    </body>
</html>
