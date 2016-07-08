<?php /* Smarty version 3.1.27, created on 2016-07-09 00:11:27
         compiled from "templates\templates\colonnaInformazioni.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:60915780250f87ff76_13875082%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23c58634159a53470de1374ac5eefdf769f823ca' => 
    array (
      0 => 'templates\\templates\\colonnaInformazioni.tpl',
      1 => 1468015882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60915780250f87ff76_13875082',
  'variables' => 
  array (
    'nomeProf' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5780250f8b8819_90363815',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5780250f8b8819_90363815')) {
function content_5780250f8b8819_90363815 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '60915780250f87ff76_13875082';
?>
<div id='wrapServizi'>
    <p>Agenda di <?php echo $_smarty_tpl->tpl_vars['nomeProf']->value;?>
:</p>
</div><?php }
}
?>