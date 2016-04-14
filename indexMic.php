<?php
require_once('includes/autoload.inc.php');

$age = new EAgenda(array(),30);
$giorniDisponibile=array(
    'lun'=>'00:00-1:00,14:00-18:00',
    'mar'=>'00:00-8:00',
    'mer'=>'07:00-15:00',
    'gio'=>''
);
$age->setOrari($giorniDisponibile);

//$fute = new FUtente();
//$ute = new EUtente("Utente","Cognome","2016-04-14","ABCDEF92S06E243D","m","cacciucacciu@cacciu.com","blablabla");
//
//$set = new EServizio("ServizioProf","des","settore",1);
//
//$pro = new EProfessionista($ute->getNome(),$ute->getCognome(),$ute->getDataNascita(),
//                           $ute->getCodiceFiscale(),$ute->getSesso(),$ute->getEmail(),
//                           $ute->getPassword(),null,array($set),"settore","08:00-10:00");
//
//$ute2 = $pro->getUtenteDaProfessionista();
//
//$fpro = new FProfessionista();
//$fpro->inserisciProfessionista($pro);


$fpro = new FProfessionista();
$prof = $fpro->caricaProfessionistaDaDB(20);

var_dump($prof);

?>
