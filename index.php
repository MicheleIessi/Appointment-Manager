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
            $eser = $ser->caricaServizioDaDb("Visita");
            $Fapp = new FAppuntamento();
            $app = $Fapp->caricaAppuntamentoDaDb("123456,222222,2016-03-19");
            $eser->setNomeServizio("Prova");
            $ser->aggiornaServizio($eser);
            $app->setVisita($eser);
            $app->setIDProfessionista("123457");
            $Fapp->aggiornaAppuntamento($app);
        ?>
    </body>
</html>

