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
        include_once 'Entity/EPersona.php';
        include_once 'Entity/EProfessionista.php';
        include_once 'Entity/EUtente.php';
            try {
                $per = new EPersona("Michele", "Iessi", "6/11/1992", "SSIMHL92S06E243D", "m");
            } catch (Exception $exc) {
                echo $exc->getMessage() . ", codice errore: " . $exc->getCode();
            }
            
            echo $per->getNome();
                    
            try {
                $utente = new EUtente($per->getNome(), 
                                      $per->getCognome(), 
                                      $per->getDN(), 
                                      $per->getCF(), 
                                      $per->getSesso(), 
                                      $e = 'a@a.a', 
                                      $p = "12345678", 
                                      $id = "123456");
            } catch (Exception $exc) {
                echo $exc->getMessage() . ", codice errore: " . $exc.getcode();
            }



            
//            $prof = new EProfessionista($per->getNome(), 
//                                        $per->getCognome(), 
//                                        $per->getDN(), 
//                                        $per->getCF(), 
//                                        $per->getSesso(), $e, $p, $id, $so, $set, $or, $al)
        
        ?>
    </body>
</html>
