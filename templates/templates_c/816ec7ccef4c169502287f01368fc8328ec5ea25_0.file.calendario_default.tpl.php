<?php /* Smarty version 3.1.27, created on 2016-07-06 10:42:51
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:19792577cc48b9e8040_82744014%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1467794419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19792577cc48b9e8040_82744014',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577cc48b9eab67_41711314',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577cc48b9eab67_41711314')) {
function content_577cc48b9eab67_41711314 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '19792577cc48b9e8040_82744014';
?>
<link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
<link type="text/css" rel="stylesheet" href="View/css/calendario.css" />

<div id='calendar'></div>
<?php }
}
?>