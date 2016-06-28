<?php
require_once('includes/autoload.inc.php');
$type = $_REQUEST['type'];

if($type == 'fetch') {
    $id=$_COOKIE['lastCalendar'];
    $fapp = new FAgenda();
    $agenda = $fapp->caricaAgenda($id);
    $impegni = $agenda->getImpegni();
    $events = array();
    foreach($impegni as $appuntamento) {
        $evento = array();
        $evento['id']=$appuntamento->getIDAppuntamento();
        $evento['title']=$appuntamento->getVisita()->getNomeServizio();
        $evento['start']=$appuntamento->getData()." ".$appuntamento->getOrario();
        $durata = $appuntamento->getVisita()->getDurata();
        $evento['end']=processa($evento['start'],$durata);
        $evento['editable']=false;
        $evento['allDay']="";
        array_push($events,$evento);
    }
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