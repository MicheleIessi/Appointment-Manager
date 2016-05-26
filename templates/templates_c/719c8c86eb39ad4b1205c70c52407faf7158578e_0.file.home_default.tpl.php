<?php /* Smarty version 3.1.27, created on 2016-05-26 21:20:39
         compiled from "templates\templates\home_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:845157474c879536a5_99744235%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '719c8c86eb39ad4b1205c70c52407faf7158578e' => 
    array (
      0 => 'templates\\templates\\home_default.tpl',
      1 => 1464290402,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '845157474c879536a5_99744235',
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57474c8799f181_21178418',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57474c8799f181_21178418')) {
function content_57474c8799f181_21178418 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '845157474c879536a5_99744235';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'><?php echo '</script'; ?>
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
        <div id='content'>
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

        </div>
    </body>
</html><?php }
}
?>