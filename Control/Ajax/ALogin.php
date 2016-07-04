<?php
set_include_path(get_include_path() . PATH_SEPARATOR ."../../htdocs/appointment-manager");
require_once('includes/autoload.inc.php');

$task = $_REQUEST['task'];
$CLog = new CLogin();

echo $CLog->smista($task);