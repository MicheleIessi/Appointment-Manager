<?php /* Smarty version 3.1.27, created on 2016-07-11 11:10:29
         compiled from "templates\templates\calendario_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:390257836285a871f2_43729096%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816ec7ccef4c169502287f01368fc8328ec5ea25' => 
    array (
      0 => 'templates\\templates\\calendario_default.tpl',
      1 => 1468228094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '390257836285a871f2_43729096',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57836285ac0859_67300770',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57836285ac0859_67300770')) {
function content_57836285ac0859_67300770 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '390257836285a871f2_43729096';
?>
<head>
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
</head>
<body>

    <div id='calendar'></div>

</body><?php }
}
?>