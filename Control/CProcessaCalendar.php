<?php
require_once('includes/autoload.inc.php');
$type = $_REQUEST['type'];


if($type == 'fetch') {
    $id=$_COOKIE['lastCalendar'];
    $fapp = new FAppuntamento();
    $res = $fapp->caricaAppuntamentiProfessionista($id);
    $events = array();
    $i=1;
    foreach($res as $event) {
        $evento = array();
        $evento['id']=$i;
        $evento['title']=$event['visita'];
        $evento['start']=$event['data']." ".$event['orario'];
        $evento['editable']=false;
        $evento['allDay']="";
        array_push($events,$evento);
        $i++;
    }
    echo json_encode($events);
}