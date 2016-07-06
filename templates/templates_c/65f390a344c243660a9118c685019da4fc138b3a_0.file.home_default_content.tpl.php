<?php /* Smarty version 3.1.27, created on 2016-07-06 10:40:36
         compiled from "templates\templates\home_default_content.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:29877577cc404973d13_91939890%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f390a344c243660a9118c685019da4fc138b3a' => 
    array (
      0 => 'templates\\templates\\home_default_content.tpl',
      1 => 1467794419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29877577cc404973d13_91939890',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577cc404d29759_08584301',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577cc404d29759_08584301')) {
function content_577cc404d29759_08584301 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '29877577cc404973d13_91939890';
?>
<div id="contenutoDefault">
    <p>Contenuto di default</p>
    <a href="?controller=calendario&idp=1">Clicca per il calendario</a>
    <a href="?controller=lista&task=lista">Clicca per la lista</a>
</div><?php }
}
?>