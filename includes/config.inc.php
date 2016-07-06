<?php

global $config;
$dbms = 'mysql';

$config[$dbms]['username'] = 'root';
$config[$dbms]['password'] = '';
$config[$dbms]['hostname'] = 'localhost';
$config[$dbms]['database'] = 'manager';

$config['smarty']['template_dir'] = 'templates/templates';
$config['smarty']['compile_dir'] = 'templates/templates_c';
$config['smarty']['config_dir'] = 'templates/configs';
$config['smarty']['cache_dir'] = 'templates/templates';

$config['smtp']['host'] = 'smtp.gmail.com';
$config['smtp']['port'] = '587';
$config['smtp']['smtpauth'] = true;
$config['smtp']['username'] = 'progettoappointmentmanager@gmail.com';
$config['smtp']['password'] = 'progetto123';


$config['home'][0] = array('testo'=>'chi siamo','link'=>'?controller=info&action=informazioni');
$config['home'][1] = array('testo'=>'contatti','link'=>'?controller=info&action=contatti');

?>