<?php

require_once 'includes/autoload.inc.php';
// Processo la chiamata Ajax
$FUte = new FUtente();
$tipo = $_REQUEST['tipo'];
$valore = trim($_REQUEST['valore']);
$sessione = new USession();
$id = $sessione->getValore('idUtente');
if($id>=0){
$EUte = $FUte->caricaUtenteDaDb($id);
$mailVecchia = $EUte->getEmail();
$cfVecchio = $EUte->getCodiceFiscale();
if(($tipo == 'email' && strtolower($valore) != $mailVecchia) || ($tipo == 'codiceFiscale' && strtoupper($valore) != $cfVecchio)){
    echo json_encode(!$FUte->controllaEsistenza($tipo,$valore));
}
else
{echo json_encode(true);}}
else{
switch($tipo){
    case 'email': echo json_encode(!$FUte->controllaEsistenza($tipo, $valore));
    break;
    case 'codiceFiscale': echo json_encode(!$FUte->controllaEsistenza($tipo, $valore));
    break;
}
 
    
}
