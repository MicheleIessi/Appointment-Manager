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
        require 'Entity/EPersona.php';
        require 'Entity/EProfessionista.php';
            try {
                $per = new EPersona("Michele", "Iessi", "6/11/1992", "SSIMHL92S06E243D", "m");
            } catch (Exception $exc) {
                echo $exc->getMessage() . ", codice errore:" . $exc->getCode();
            }
            
            echo $per->getNome();
                    
            $prof = new EProfessionista();
        
        ?>
    </body>
</html>
