<?php
require_once('includes/autoload.inc.php');
$type = $_REQUEST['type'];
$sessione = new USession();

if($type == 'fetch') {
    $id=$_COOKIE['lastCalendar'];
    $fapp = new FAgenda();
    $agenda = $fapp->caricaAgenda($id);
    $impegni = $agenda->getImpegni();
    $events = array();
    $tipo = $sessione->getValore('tipo');
    $FUte = new FUtente();
    foreach($impegni as $appuntamento) {
        $evento = array();
        //attributi che non dipendono dal tipo di utente che ha richiesto il calendario
        $evento['id']=$appuntamento->getIDAppuntamento();
        $evento['start']=$appuntamento->getData()." ".$appuntamento->getOrario();
        $durata = $appuntamento->getVisita()->getDurata();
        $evento['end']=processa($evento['start'],$durata);
        $evento['allDay']="";
        $evento['editable']=false; //questo poi dovrà cambiare in base all'id dell'utente che lo sta guardando:
                                   //se è il proprietario del calendario dovrà essere true
        //attributi che dipendono dal tipo di utente che ha richiesto il calendario
        if($tipo == 'cliente') {
            $evento['title'] = "Orario già prenotato";
            $evento['color'] = '#777777';
        }
        else if($tipo == 'professionista') {
            $idCliente = $appuntamento->getIDCliente();
            $utente = $FUte->caricaUtenteDaDb($idCliente);
            $nomeUtente = $utente->getNome();
            $cognomeUtente = $utente->getCognome();
            $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con $nomeUtente $cognomeUtente";
        }
        array_push($events,$evento);
    }
    
    /*  La struttura dei JSON events è la seguente: 
     *  
     *  events[ 
     *          id:    'aaa',
     *          title: 'bbb',
     *          start: 'ccc',
     *          editable: false,
     *          allDay: /
     *        ]
     * 
     *     In verità ci sono delle differenze nel caso in cui si è un cliente o un professionista: 
     *     il cliente ad esempio non dovrebbe poter vedere il titolo degli appuntamenti del professionista,
     *     inoltre ha il valore editable posto a false; al contrario il professionista avrà editable=true
     */
    
    echo json_encode($events);
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