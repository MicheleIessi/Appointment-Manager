<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $config;
$dbms = 'mysql';

$config[$dbms]['username'] = 'root';
$config[$dbms]['password'] = '';
$config[$dbms]['hostname'] = 'localhost';
$config[$dbms]['database'] = 'prova';

$config['url'] = 'localhost/appointment-manager';

$config['smarty']['template_dir'] = 'templates/templates';
$config['smarty']['compile_dir'] = 'templates/templates_c';
$config['smarty']['config_dir'] = 'templates/configs';
$config['smarty']['cache_dir'] = 'templates/cache';

?>