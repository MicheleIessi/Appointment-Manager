<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        // Prova riferimento-valore:
        
        function pr(&$var)     {
            $var++;
        }
        
        function pv($var)       {
            $var++;
        }
        
        $a=5;
        pr($a);
        echo "$a";
        
        $b=5;
        pv(b);
        echo "$b";
        
        ?>
    </body>
</html>
