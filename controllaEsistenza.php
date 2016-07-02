<?php
// Processo la chiamata Ajax
require_once 'includes/autoload.inc.php';

$FUte = new FUtente();
$tipo = $_REQUEST['tipo'];
$valore = $_REQUEST['valore'];
$valore = trim($valore);

echo json_encode(!$FUte->controllaEsistenza($tipo,$valore));