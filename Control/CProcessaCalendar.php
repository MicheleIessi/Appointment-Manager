<?php
require_once('includes/autoload.inc.php');

$type = $_REQUEST['type'];
$sessione = new USession();
$idUtente = $sessione->getValore('idUtente');
$idProf = $sessione->getValore('idCalendario');
$events = array();

/* INIZIALIZZO ISTANZE DEGLI OGGETTI CHE MI SERVIRANNO */

$FPro = new FProfessionista();
$FUte = new FUtente();
$FAge = new FAgenda();
$FSer = new FServizio();
$FApp = new FAppuntamento();

/* QUI CARICO GLI ORARI IN CUI IL PROFESSIONISTA NON E' DISPONIBILE E LI INSERISCO SOTTO FORMA DI EVENTI BACKGROUND */
$EPro = $FPro->caricaProfessionistaDaDB($idProf);
$impegni = $EPro->getOrariLavorativi();
$arrBackground = generaEventiOrari($impegni);
foreach($arrBackground as $giorno) {
    array_push($events,$giorno);
}
switch($type) {
    /* FETCH DEGLI APPUNTAMENTI GIA' PRESENTI NEL DATABASE */
    case 'fetch': {
        $agenda = $FAge->caricaAgenda($idProf);
        $impegni = $agenda->getImpegni();
        $tipo = $sessione->getValore('tipo');
        foreach ($impegni as $appuntamento) {
        $evento = array();
                //attributi che non dipendono dal tipo di utente che ha richiesto il calendario
            $evento['id'] = $appuntamento->getIDAppuntamento();
            $evento['start'] = $appuntamento->getData()." ".$appuntamento->getOrario();
            $durata = $appuntamento->getVisita()->getDurata();
            $evento['end'] = processa($evento['start'], $durata);
            $evento['allDay'] = "";
            $evento['editable'] = false; //questo poi dovrà cambiare in base all'id dell'utente che lo sta guardando:
                //se è il proprietario del calendario dovrà essere true
                //attributi che dipendono dal tipo di utente che ha richiesto il calendario
            if ($tipo == 'cliente') {
                $evento['title'] = "Orario già prenotato";
                $evento['color'] = '#777777';
                }
            else if ($tipo == 'professionista') {
                $idCliente = $appuntamento->getIDCliente();
                $utente = $FUte->caricaUtenteDaDb($idCliente);
                $nomeUtente = $utente->getNome();
                $cognomeUtente = $utente->getCognome();
                $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con $nomeUtente $cognomeUtente";
                }

            array_push($events, $evento);
        }
        echo json_encode($events);
    }
    break;
    /* INSERIMENTO NUOVO APPUNTAMENTO */
    case 'new': {

        $inizio = explode('T',$_POST['orarioInizio']);
        $data = $inizio[0];
        $orarioInizio = $inizio[1];
        $title = $_POST['servizio'];//nome del servizio
        $ESer = $FSer->caricaServizioDaDb($title);
        $IDC = $idUtente;
        $IDP = $idProf;


        $appuntamento = new EAppuntamento($IDP,$IDC,$data,$orarioInizio,$ESer);
        $FApp->inserisciAppuntamento($appuntamento);
        $IDApp = $FApp->getLastID();


    
        echo json_encode(array('status'=>'success','idAppuntamento'=>$IDApp));

    }
}

function processa($inizio,$durata) {
    $parti = array_map(function($num) {
        return (int) $num;
    }, explode(':', $durata));

    $inizioConvertito = new DateTime($inizio);
    $durataConvertita = new DateInterval(sprintf('PT%uH%uM%uS',$parti[0],$parti[1],$parti[2]));
    $inizioConvertito->add($durataConvertita);
    $fineConvertita = $inizioConvertito->format('Y-m-d H:i:s');
    return $fineConvertita;
}


/*
 *
 *  DA 00:00 AL PRIMO ORARIO DEL GIORNO
 *  DALLA FINE DEL PRIMO ORARIO DEL GIORNO ALL'INIZIO DEL SECONDO ORARIO
 *  COSì VIA FINO A 00:00
 *
 */
function generaEventiOrari($arrayOrari) {
    $orariConvertiti = array();
    $i=0;   //rappresenta il giorno della settimana
    foreach($arrayOrari as $giorno) {
        $orari = explode(',', $giorno);
        // devo prendere gli intervalli a due a due e fare la stessa cosa praticamente
        $numeroIntervalli = count($orari);
        //inserisco il primo evento background
        $primoOrario = explode('-',$orari[0]);
        $primoEvento = creaEventoBackground('00:00:00',$primoOrario[0],$i);
        array_push($orariConvertiti, $primoEvento);
        //inserisco gli eventi intermedi
        for ($k=0; $k < $numeroIntervalli-1; $k++) {
            $intervallo1 = explode('-',$orari[$k]);
            $intervallo2 = explode('-',$orari[$k+1]);
            $inizio = $intervallo1[1];
            $fine = $intervallo2[0];
            $eventoInMezzo = creaEventoBackground($inizio,$fine,$i);
            array_push($orariConvertiti, $eventoInMezzo);
        }

        $ultimoOrario = explode('-',$orari[$numeroIntervalli-1]);
        $intervallo2 = $ultimoOrario[1];
        $ultimoEvento = creaEventoBackground($intervallo2,'24:00:00',$i);
        array_push($orariConvertiti,$ultimoEvento);
        $i++;
    }
    return $orariConvertiti;
}

function creaEventoBackground($inizio,$fine,$giorno) {

    $singoloEvento['id'] = "NonDisponibile";
    $singoloEvento['title'] = "";
    $singoloEvento['start'] = $inizio;
    $singoloEvento['end'] = $fine;
    $singoloEvento['rendering'] = 'background';
    $singoloEvento['allDay'] = "";
    $singoloEvento['editable'] = false;
    $singoloEvento['color'] = '#f04124';
    $singoloEvento['dow'] = [$giorno];

    return $singoloEvento;
}