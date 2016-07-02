<?php

require_once 'includes/autoload.inc.php';

// Processo la chiamata Ajax

$FUte = new FUtente();
$tipo = $_REQUEST['tipo'];
$valore = $_REQUEST['valore'];
$valore = trim($valore);

echo json_encode(!$FUte->controllaEsistenza($tipo,$valore));