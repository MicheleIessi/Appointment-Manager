<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("includes/autoload.inc.php");
$logm=$_POST["email"];
$logp=$_POST["password"];
$FUte=new FUtente();
$chiave="mail";
$esito=$FUte->controllaEsistenza("email", $logm);
if(!$esito)
{ echo "A";}
elseif(!$Ute=$FUte->caricaUtenteDaLogin($logm,$logp))
{ echo "B";}
else
{ echo "C";
  $CLog=new CLogin();
  $CLog->processaLogin($Ute);
}