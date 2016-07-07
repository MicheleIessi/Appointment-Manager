<?php /* Smarty version 3.1.27, created on 2016-07-06 13:23:00
         compiled from "templates\templates\home_default_content.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10598577cea14817cf3_75448801%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f390a344c243660a9118c685019da4fc138b3a' => 
    array (
      0 => 'templates\\templates\\home_default_content.tpl',
      1 => 1467804174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10598577cea14817cf3_75448801',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577cea1484d077_17883933',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577cea1484d077_17883933')) {
function content_577cea1484d077_17883933 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10598577cea14817cf3_75448801';
?>
<div id="contenutoDefault">
    <p>Contenuto di default</p>
    <a href="?controller=calendario&idp=1">Clicca per il calendario</a><br/>
    <a href="?controller=lista&task=lista">Clicca per la lista</a>
</div><?php }
}
?>