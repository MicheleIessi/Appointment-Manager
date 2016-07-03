<?php

/*
 * Controlli lato server sulla form modificaUtente: in realtà tutti i controlli vengono effettuati quando
 * vengono chiamati i metodi set di EUtente
*/

require_once 'includes/autoload.inc.php';

$sessione= new USession();

$FUte= new FUtente();
$EUte= $FUte->caricaUtenteDaDb($sessione->getValore('idUtente'));

// Recupero le variabili da $_REQUEST

$nome= ucfirst($_REQUEST['nome']);
$cognome= ucfirst($_REQUEST['cognome']);
$dataNascita= dataItaToISO($_REQUEST['dataNascita']);
$codiceFiscale= $_REQUEST['codiceFiscale'];
$sesso= $_REQUEST['sesso'];
$email= $_REQUEST['email'];
$password1= $_REQUEST['password1'];
$password2= $_REQUEST['password2'];

try {
    
    $EUte->setNome($nome);      // controllo sulla lunghezza già presente in setNome
    $EUte->setCognome($cognome);
    $EUte->setCodFis($codiceFiscale);
    $EUte->setDataNascita($dataNascita);
    $EUte->setSesso($sesso);
    $EUte->setEmail($email);
    
    if($password1==$password2)  {
        $EUte->setPassword($password1);
    }
    else 
        throw new Exception('Non hai messo password uguali.');
    
    $FUte->aggiornaUtente($EUte);

} catch(Exception $e) {
    errore($e->getMessage());
}



//------------------------------------------------------------------------------


function errore($messaggioErrore)   {
    $sessione = new USession();
    $sessione->impostaValore('messaggioErrore', $messaggioErrore);
    header("location: ./?controller=modificaUtente");
}

function dataItaToISO($data) {
    $arrayData=  explode("/", $data);
    
    $giorno=$arrayData[0];
    $mese=$arrayData[1];
    $anno=$arrayData[2];
    
    $dataISO= $anno."-".$mese."-".$giorno;
    return $dataISO;
}
