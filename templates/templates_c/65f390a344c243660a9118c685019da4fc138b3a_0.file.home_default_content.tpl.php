<?php /* Smarty version 3.1.27, created on 2016-06-25 20:04:14
         compiled from "templates\templates\home_default_content.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17787576ec79ecd1e44_95835439%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f390a344c243660a9118c685019da4fc138b3a' => 
    array (
      0 => 'templates\\templates\\home_default_content.tpl',
      1 => 1466876138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17787576ec79ecd1e44_95835439',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576ec79ed04fc3_36113100',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576ec79ed04fc3_36113100')) {
function content_576ec79ed04fc3_36113100 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17787576ec79ecd1e44_95835439';
?>
<p>Contenuto di default</p>
<a href="?controller=calendario&idp=1">Clicca per il calendario</a>
<a href="?controller=lista&task=lista">Clicca per la lista</a><?php }
}
?>