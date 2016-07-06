<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');

$task = $_POST['type'];

$CCal = new CCalendar();
echo json_encode($CCal->smista($task));