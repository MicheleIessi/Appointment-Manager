<?php /* Smarty version 3.1.27, created on 2016-07-06 01:01:08
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:4413577c3c34b51499_20121388%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1467759333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4413577c3c34b51499_20121388',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577c3c34b95674_91352356',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577c3c34b95674_91352356')) {
function content_577c3c34b95674_91352356 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '4413577c3c34b51499_20121388';
?>
<link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
<link type="text/css" rel="stylesheet" href="View/css/calendario.css" />

<div id='calendar'></div>
<?php }
}
?>