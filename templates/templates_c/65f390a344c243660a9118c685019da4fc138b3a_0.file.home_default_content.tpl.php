<?php /* Smarty version 3.1.27, created on 2016-06-25 18:34:42
         compiled from "templates\templates\home_default_content.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:22588576eb2a29f1ce7_50390483%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f390a344c243660a9118c685019da4fc138b3a' => 
    array (
      0 => 'templates\\templates\\home_default_content.tpl',
      1 => 1466872479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22588576eb2a29f1ce7_50390483',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576eb2a2da12a4_86990277',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576eb2a2da12a4_86990277')) {
function content_576eb2a2da12a4_86990277 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '22588576eb2a29f1ce7_50390483';
?>
<p>Contenuto di default</p>
<a href="?controller=calendario&idp=1">Clicca per il calendario</a>
<a href="?controller=lista&task=lista">Clicca per la lista</a><?php }
}
?>