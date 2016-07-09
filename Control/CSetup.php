<?php

class CSetup {

    public function smista() {
        $view = new View();
        $task = $view->getTask();
        switch($task) {
            case 'setup': {
                $this->setup();
                break;
            }
            default: {
                $VSetup = new VSetup();
                $VSetup->display('setup.tpl');
                break;
            }
        }
    }

    public function setup() {

        $VSet = new VSetup;

        $datiAdmin = $VSet->getDatiAdmin();
        $datiDB = $VSet->getDatiDB();
        $datiMail = $VSet->getDatiMail();

        if($datiAdmin && $datiDB && $datiMail) {

            try {
                // dati anagrafici amministratore

                $idNum       = 0; //l'admin ha id speciale 0
                $nome        = ucfirst($datiAdmin['nomeAdmin']);
                $cognome     = ucfirst($datiAdmin['cognomeAdmin']);
                $dataNascita = $datiAdmin['dataNascitaAdmin'];
                $codiceFis   = $datiAdmin['codiceFiscaleAdmin'];
                $sesso       = $datiAdmin['sessoAdmin'];
                $email       = $datiAdmin['emailAdmin'];

                if($datiAdmin['passwordAdmin1'] != $datiAdmin['passwordAdmin2']) {
                    throw new Exception("Le password scelte non coincidono");
                }

                $pass = $datiAdmin['passwordAdmin1'];

                // creo un oggetto eutente per verificare che tutti i parametri rispettino le regexp
                // se ci sono errori l'eccezione verrà 'catturata' e verrà stampata a video

                $EAdmin = new EUtente($nome,$cognome,$dataNascita,$codiceFis,$sesso,$email,$pass,0,0);
                // l'admin ha codice di conferma 0 (è già attivo) e idutente 0 (riservato all'admin)

                // sezione db

                $dbms        = $datiDB['dbms'];
                $dbuser      = $datiDB['dbuser'];
                $dbpass      = $datiDB['dbpass'];
                $dbname      = $datiDB['dbname'];
                $dbhost      = $datiDB['dbhost'];

                // sezione mail

                $smtphost    = $datiMail['smtphost'];
                $smtpport    = $datiMail['smtpport'];
                $smtpuser    = $datiMail['smtpuser'];
                $smtppass    = $datiMail['smtppass'];

                // CREAZIONE DB E FILE DI CONFIGURAZIONE
                //// creo e uso il database appena creato
                $Fdb = new Fdb($dbms,$dbhost,$dbuser,$dbpass);
                $sql = "CREATE DATABASE `$dbname`;";
                $Fdb->query($sql);
                $sql = "USE `$dbname`;";
                $Fdb->query($sql);
                //// creo le tabelle prendendo il codice sql dal file setup.sql
                $sql = file_get_contents('Setup/setup.sql');
                $Fdb->query($sql);
                //// a questo punto il database dovrebbe essere stato creato correttamente
                //// inserisco l'amministratore nella tabella utenti

                $sql = "INSERT INTO `utente` (`numID`,`nome`,`cognome`,`dataNascita`,`codiceFiscale`,`sesso`,`email`,`password`,`codiceConferma`)".
                    "VALUES ('$idNum','$nome','$cognome','$dataNascita','$codiceFis','$sesso','$email','$pass','0');";
                $Fdb->query($sql);
                $sql = "UPDATE `utente` SET `numID` = '0' WHERE `numID` = '1';";
                $Fdb->query($sql);
                $sql = "ALTER TABLE `utente` AUTO_INCREMENT = 1";
                $Fdb->query($sql);

                // CREAZIONE FILE CONFIGURAZIONE
                $eol = PHP_EOL;
                $config = "<?php".$eol.
                    $eol.
                    'global $config;'.$eol.
                    '$'."dbms = '$dbms';".$eol.
                    $eol.
                    '$config[$dbms]['."'username'] = '$dbuser';".$eol.
                    '$config[$dbms]['."'password'] = '$dbpass';".$eol.
                    '$config[$dbms]['."'hostname'] = '$dbhost';".$eol.
                    '$config[$dbms]['."'database'] = '$dbname';".$eol.
                    $eol.
                    '$'."config['smarty']['template_dir'] = 'templates/templates';".$eol.
                    '$'."config['smarty']['compile_dir'] = 'templates/templates_c';".$eol.
                    '$'."config['smarty']['config_dir'] = 'templates/configs';".$eol.
                    '$'."config['smarty']['cache_dir'] = 'templates/cache';".$eol.
                    $eol.
                    '$'."config['smtp']['host'] = '$smtphost';".$eol.
                    '$'."config['smtp']['port'] = '$smtpport';".$eol.
                    '$'."config['smtp']['smtpauth'] = true;".$eol.
                    '$'."config['smtp']['username'] = '$smtpuser';".$eol.
                    '$'."config['smtp']['password'] = '$smtppass';".$eol.
                    $eol.
                    $eol.
                    '$'."config['home'][0] = array('testo'=>'chi siamo','link'=>'?controller=info&task=informazioni');".$eol.
                    '$'."config['home'][1] = array('testo'=>'credits','link'=>'?controller=info&task=credits');".$eol.
                    $eol.
                    "?>";
                $UFile = new UFile();
                $file = $UFile->apriFile('includes','config.inc.php','w');
                $UFile->scriviFile($config,$file);
                $UFile->chiudiFile($file);
                $CIndex = new CIndex();
                $sessione = new USession();
                $sessione->fineSessione();
                $CIndex->impostaPagina();

            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        else {
            echo "Ci sono stati dei problemi nel setup.<br>";
            var_dump($datiAdmin);
            var_dump($datiDB);
            var_dump($datiMail);
        }
    }
}