<?php /* Smarty version 3.1.27, created on 2016-07-09 19:39:28
         compiled from "templates\templates\informazioni.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:20896578136d095d424_23985362%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53ef6b1f51c4e88ca230448ddc4b21a6de788f17' => 
    array (
      0 => 'templates\\templates\\informazioni.tpl',
      1 => 1468085904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20896578136d095d424_23985362',
  'variables' => 
  array (
    'titolo' => 0,
    'sezione1' => 0,
    'sotto1' => 0,
    'testo1' => 0,
    'sezione2' => 0,
    'sotto2' => 0,
    'testo2' => 0,
    'sezione3' => 0,
    'sotto3' => 0,
    'testo3' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578136d09a5536_29037100',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578136d09a5536_29037100')) {
function content_578136d09a5536_29037100 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '20896578136d095d424_23985362';
?>
<link rel="stylesheet" type="text/css" href="View/css/info.css">

<p id="titolo"><?php echo $_smarty_tpl->tpl_vars['titolo']->value;?>
</p>
<?php if ($_smarty_tpl->tpl_vars['sezione1']->value) {?>
<div id="primaParte">
    <h3><?php echo $_smarty_tpl->tpl_vars['sotto1']->value;?>
</h3>
    <p class="testo"><?php echo $_smarty_tpl->tpl_vars['testo1']->value;?>
</p>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['sezione2']->value) {?>
<div id="secondaParte">
    <h3><?php echo $_smarty_tpl->tpl_vars['sotto2']->value;?>
</h3>
    <p class="testo"><?php echo $_smarty_tpl->tpl_vars['testo2']->value;?>
</p>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['sezione3']->value) {?>
<div id="terzaParte">
    <h3><?php echo $_smarty_tpl->tpl_vars['sotto3']->value;?>
</h3>
    <p class="testo"><?php echo $_smarty_tpl->tpl_vars['testo3']->value;?>
</p>
</div>
<?php }
}
}
?>