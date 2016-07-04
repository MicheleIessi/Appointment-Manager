<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');
$task = $_REQUEST['task'];
$CLog = new CLogin();

echo $CLog->smista($task);
