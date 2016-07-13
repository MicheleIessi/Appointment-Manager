<?php /* Smarty version 3.1.27, created on 2016-07-12 17:35:23
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:905957850e3b915632_71861072%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1468243666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '905957850e3b915632_71861072',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57850e3b9470b6_20195406',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57850e3b9470b6_20195406')) {
function content_57850e3b9470b6_20195406 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '905957850e3b915632_71861072';
?>
<link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
<link type="text/css" rel="stylesheet" href="css/calendario.css" />
<?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/fullcalendar.min.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lang-all.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/JCalendar.js'><?php echo '</script'; ?>
>

<div id='calendar'></div><?php }
}
?>