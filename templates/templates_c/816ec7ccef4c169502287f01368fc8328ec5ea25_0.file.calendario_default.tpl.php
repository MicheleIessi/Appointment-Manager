<?php /* Smarty version 3.1.27, created on 2016-07-05 18:26:02
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:20418577bdf9a868d56_23138841%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1467735937,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20418577bdf9a868d56_23138841',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577bdf9a89b588_85623886',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577bdf9a89b588_85623886')) {
function content_577bdf9a89b588_85623886 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '20418577bdf9a868d56_23138841';
?>
<link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
<link type="text/css" rel="stylesheet" href="View/css/calendario.css" />

<div id='calendar'></div>
<?php }
}
?>