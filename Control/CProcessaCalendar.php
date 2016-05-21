<?php
require('includes/autoload.inc.php');
$type = $_POST['type'];
$id = $_POST['id'];
//$type = $_GET['type'];
//$id = $_GET['id'];


if($type == 'fetch') { //devo fare in modo che prenda tutti gli eventi da un id e che
    //ritorni un json che li contiene opportunamente formattati

    $fapp = new FAppuntamento();

    $res = $fapp->caricaAppuntamentiProfessionista($id);
    $events = array();
    $id=1;
    foreach($res as $event) {
        $evento = array();
        $evento['id']=$id;
        $evento['title']=$event['visita'];
        $evento['start']=$event['data']." ".$event['orario'];
        $evento['editable']=false;
        $evento['allDay']="";
        array_push($events,$evento);
        $id++;
    }

    echo json_encode($events);
}
