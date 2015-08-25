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
        include_once 'Entity/EAppuntamento.php';
        include_once 'Entity/EServizio.php';
        include_once 'Entity/EAgenda.php';
            try {
                $per = new EPersona("Michele", "Iessi", "6/11/1992", "SSIMHL92S06E243D", "m");
            } catch (Exception $exc) {
                echo $exc->getMessage() . ", codice errore: " . $exc->getCode();
            }
            
            echo $per->getNome()    .    " " .
                 $per->getCognome() .    " " .
                 $per->getDN()      .    " " .
                 $per->getCF()      .    " " .
                 $per->getSesso();
                    
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
            echo "<br>";
            echo $utente->getNome()    .    " " .
                 $utente->getCognome() .    " " .
                 $utente->getDN()      .    " " .
                 $utente->getCF()      .    " " .
                 $utente->getSesso()   .    " " .
                 $utente->getEmail()   .    " " .
                 $utente->getPassword().    " " .
                 $utente->getID();

            $ser = new EServizio("prova", "prova", "cardiologia", "2");
            $app = new EAppuntamento("25/08/2015", "15:00-16:00", $ser, $utente->getID(), $utente->getID());
//            $age = new EAgenda([$app]);
            $servizi = ["visita","chirurgia"];
            $orario = "09:00-16:30";
            try {
            $prof = new EProfessionista($utente->getNome(), 
                                        $utente->getCognome(), 
                                        $utente->getDN(), 
                                        $utente->getCF(), 
                                        $utente->getSesso(), 
                                        $utente->getEmail(), 
                                        $utente->getPassword(), 
                                        $utente->getID(), 
                                        $servizi, //servizi offerti
                                        ["cardiologia","chirurgia"], //settori
                                        $orario //orario
                                        );
            } catch (Exception $exc) {
                echo $exc->getMessage() . ", codice errore : " . $exc->getCode();
            }
            foreach ($prof->getAgendaLavoro()->getBlocchi() as $blocco) {
                echo "<br>".var_dump($blocco);
            }
            
            $prof->setOrari("09:00-14:00");
            echo $prof->getOrari();
            
            $prof->getAgendaLavoro()->aggiungiAppuntamento($app);
            
            $prof->getAgendaLavoro()->cambiaBlocco("12:30",NULL);
            foreach ($prof->getAgendaLavoro()->getBlocchi() as $blocco) {
                echo "<br>".var_dump($blocco);
            }

        ?>
    </body>
</html>
