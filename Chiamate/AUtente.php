<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/appointment-manager/includes/autoload.inc.php');

$task = $_REQUEST['task'];

$CUte = new CUtente();

if($task == 'modifica') {
    $CUte->controllaForm();
}
else if($task == 'caricaImmagine') {
    $CUte->caricaImmagine();
}