<?php /* Smarty version 3.1.27, created on 2016-05-27 22:49:17
         compiled from "templates\templates\home_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:266215748b2cdc3e535_13751889%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '719c8c86eb39ad4b1205c70c52407faf7158578e' => 
    array (
      0 => 'templates\\templates\\home_default.tpl',
      1 => 1464382140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266215748b2cdc3e535_13751889',
  'variables' => 
  array (
    'title' => 0,
    'banner' => 0,
    'main_content' => 0,
    'right_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5748b2cdc85899_73573961',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5748b2cdc85899_73573961')) {
function content_5748b2cdc85899_73573961 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '266215748b2cdc3e535_13751889';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link href='JS/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
        <link href='View/css/prova.css' rel="stylesheet" />
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
        <?php echo '<script'; ?>
 type="text/javascript" src="JS/jquery.leanModal.min.js"><?php echo '</script'; ?>
>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
    <?php echo $_smarty_tpl->tpl_vars['banner']->value;?>

    <div class ="mainButtons"></div>
    <div class ="main">
        <!-- MAIN CONTENT -->
        <div id='content'>
            <?php echo $_smarty_tpl->tpl_vars['main_content']->value;?>

        </div>
        <!-- SIDE CONTENT -->
        <div class="side_content">
            <?php echo $_smarty_tpl->tpl_vars['right_content']->value;?>

        </div>
        </div>
    </body>
</html><?php }
}
?>