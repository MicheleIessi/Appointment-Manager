<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');
$sessione=new USession();
$code=$_REQUEST['confirm'];
$FUte=new FUtente();
if($FUte->controllaEsistenza('codiceconferma', $code)){
    $Ute=$FUte->caricaUtenteDaConferma($code);  
    $Ute->setCodiceconferma('0');
    if($FUte->aggiornaUtente($Ute)) {
                $tipo = ucfirst($sessione->getValore('tipo'));
                $id = $sessione->getValore('idUtente');
                header("location: ../../?controller=pagina$tipo&id=$id");}
}
else
{header("location: ../../index.php");}