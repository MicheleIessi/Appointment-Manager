<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;

$config['smarty']['template_dir'] =
'templates/main/template/';
$config['smarty']['compile_dir'] =
'templates/main/templates_c/';
$config['smarty']['config_dir'] =
'templates/main/configs/';
$config['smarty']['cache_dir'] =
'templates/main/cache/';

$config['mysql']['user'] = 'root';
$config['mysql']['password'] = '';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'appointmentmanagerdb';
