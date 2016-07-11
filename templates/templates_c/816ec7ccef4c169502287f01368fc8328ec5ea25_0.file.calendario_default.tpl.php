<?php /* Smarty version 3.1.27, created on 2016-07-11 18:43:13
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:186465783cca140dce0_93544342%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1468228263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186465783cca140dce0_93544342',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5783cca146e8b0_06909708',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5783cca146e8b0_06909708')) {
function content_5783cca146e8b0_06909708 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '186465783cca140dce0_93544342';
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