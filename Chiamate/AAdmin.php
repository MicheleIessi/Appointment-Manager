<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/appointment-manager/includes/autoload.inc.php');

$task = $_REQUEST['task'];

$CAdmin = new CAdmin();
$CAdmin->smista($task);