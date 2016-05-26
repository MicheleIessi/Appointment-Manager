<?php /* Smarty version 3.1.27, created on 2016-05-26 18:57:36
         compiled from "templates\templates\indexMic.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1734057472b00b4d7a1_26023532%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0debfc34603c6d81445ce729c23a5ea3ad99d6e' => 
    array (
      0 => 'templates\\templates\\indexMic.tpl',
      1 => 1464281648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1734057472b00b4d7a1_26023532',
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57472b00bc71f4_00678848',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57472b00bc71f4_00678848')) {
function content_57472b00bc71f4_00678848 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1734057472b00b4d7a1_26023532';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset='utf-8' />
    <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/fullcalendar.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='JS/fullcalendar-2.6.1/lang-all.js'><?php echo '</script'; ?>
>
</head>
<body>
<div id='content'>
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

</div>
</body>
</html><?php }
}
?>