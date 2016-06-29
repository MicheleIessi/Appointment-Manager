<?php
require_once('includes/autoload.inc.php');
$type = $_REQUEST['type'];

if($type == 'fetch') {
    $id=$_COOKIE['lastCalendar'];
    $FApp = new FAppuntamento();
    $res = $FApp->caricaAppuntamentiProfessionista($id);
    $eventi = array();
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