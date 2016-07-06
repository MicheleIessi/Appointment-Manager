<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');
$tas = $_REQUEST['task'];
$CLog = new CLogin($tas);

echo $CLog->smista();


