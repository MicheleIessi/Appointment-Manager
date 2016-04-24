<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dbms = 'mysql';

$config[$dbms]['username'] = 'root';
$config[$dbms]['password'] = '';
$config[$dbms]['hostname'] = 'localhost';
$config[$dbms]['database'] = 'menagement';

$config['url'] = 'localhost/appointment-manager';

$config['smarty']['template_dir'] = 'templates/';
$config['smarty']['compile_dir'] = 'lib/smarty/templates_c/';
$config['smarty']['config_dir'] = '';
$config['smarty']['cache_dir'] = '';

?>