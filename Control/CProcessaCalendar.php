<?php
require_once('includes/autoload.inc.php');

$type = $_POST['type'];
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
$FCli = new FCliente();

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
            /* @var $appuntamento EAppuntamento */
            $evento = array();
                //attributi che non dipendono dal tipo di utente che ha richiesto il calendario
            $evento['id'] = $appuntamento->getIDAppuntamento();
            $evento['start'] = $appuntamento->getData()." ".$appuntamento->getOrario();
            $durata = $appuntamento->getVisita()->getDurata();
            $evento['end'] = processa($evento['start'], $durata);
            $evento['allDay'] = "";
            $evento['editable'] = false;
            if ($tipo == 'cliente') {
                $idCliente = $appuntamento->getIDCliente();
                if($idCliente == $idUtente) {
                    $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con te";
                    $evento['backgroundColor'] = '#ADFF7E';
                    $evento['textColor'] = '#000000';
                    $evento['borderColor'] = '#31DA17';
                    $evento['editable']=true;
                }
                else {
                    $evento['title'] = 'Orario già prenotato';
                    $evento['color'] = '#AAAAAA';
                    $evento['textColor'] = '#FFFFFF';
                }
            }
            else if ($tipo == 'professionista') {
                if($idUtente == $idProf) {
                    $idCliente = $appuntamento->getIDCliente();
                    $utente = $FUte->caricaUtenteDaDb($idCliente);
                    $nomeUtente = $utente->getNome();
                    $cognomeUtente = $utente->getCognome();
                    $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con $nomeUtente $cognomeUtente";
                    $evento['editable'] = true;
                }
                else {
                    $evento['title'] = 'Orario già prenotato';
                    $evento['color'] = '#AAAAAA';
                    $evento['textColor'] = '#FFFFFF';
                }
            }

            array_push($events, $evento);
        }
        echo json_encode($events);
    }
    break;
    /* INSERIMENTO NUOVO APPUNTAMENTO */
    /* il cliente può inserire un appuntamento solo se non ha già 3 appuntamenti prenotati
    /* in giorni futuri con lo stesso professionista */
    case 'new': {
        $risultato = array();
        $inizio = explode('T',$_POST['orarioInizio']);
        $data = $inizio[0];

        $arr = $FCli->getAppuntamentiFuturi($idUtente);

        if(sizeof($arr) < 3) {

            $orarioInizio = $inizio[1];
            $title = $_POST['servizio'];//nome del servizio
            $ESer = $FSer->caricaServizioDaDb($title);

            $appuntamento = new EAppuntamento($idProf, $idUtente, $data, $orarioInizio, $ESer);
            $FApp->inserisciAppuntamento($appuntamento);
            $IDApp = $FApp->getLastID();
            if($IDApp == 0) {
                $risultato['stato'] = 'errore';
                $risultato['messaggio'] = 'Si può effettuare una prenotazione per giorno con lo stesso professionista';
            }
            else {
                $EApp = $FApp->caricaAppuntamentoDaDb($IDApp);
                $risultato['stato'] = 'successo';
                $risultato['messaggio'] = 'Appuntamento aggiunto correttamente per il giorno '.$EApp->getData().' alle ore '.$EApp->getOrario().'.';
                $risultato['idAppuntamento'] = $IDApp;
            }
        }
        else {
            $risultato['stato'] = 'errore';
            $risultato['messaggio'] = 'Non si possono avere più di 3 prenotazioni attive con lo stesso professionista';
        }
        echo json_encode($risultato);
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
    $singoloEvento['color'] = '#FF9999';
    $singoloEvento['dow'] = [$giorno];

    return $singoloEvento;
}