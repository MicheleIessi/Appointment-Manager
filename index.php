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
        $es = $ser->caricaServizio("Visita generica");
        echo "<br>"."<br>"."<br>"."<br>";
        var_dump($es);
        ?>
    </body>
</html>
