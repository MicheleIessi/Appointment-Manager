<?php

require_once('includes/autoload.inc.php');

$task = $_REQUEST['task'];
$CLog = new CLogin();

echo $CLog->smista($task);