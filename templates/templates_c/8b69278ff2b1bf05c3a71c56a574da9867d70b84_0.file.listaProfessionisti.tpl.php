<?php /* Smarty version 3.1.27, created on 2016-07-09 19:12:47
         compiled from "templates\templates\listaProfessionisti.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:253805781308f945b31_91872676%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b69278ff2b1bf05c3a71c56a574da9867d70b84' => 
    array (
      0 => 'templates\\templates\\listaProfessionisti.tpl',
      1 => 1468084366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '253805781308f945b31_91872676',
  'variables' => 
  array (
    'prof' => 0,
    'professionista' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5781308f99a3f3_33707008',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5781308f99a3f3_33707008')) {
function content_5781308f99a3f3_33707008 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '253805781308f945b31_91872676';
?>
<div class="profWrapper">
    
    <div class="profContainer">
        <p class="titolo">
            Lista professionisti:
        </p>
        
        <?php
$_from = $_smarty_tpl->tpl_vars['prof']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['professionista'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['professionista']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['professionista']->value) {
$_smarty_tpl->tpl_vars['professionista']->_loop = true;
$foreach_professionista_Sav = $_smarty_tpl->tpl_vars['professionista'];
?>
            <div class="profList">
                <a href="?controller=paginaProfessionista&id=<?php echo $_smarty_tpl->tpl_vars['professionista']->value['id'];?>
"><button class="profLink"><?php echo $_smarty_tpl->tpl_vars['professionista']->value['nome'];?>
 <?php echo $_smarty_tpl->tpl_vars['professionista']->value['cognome'];?>
</button></a>
            </div>
        <?php
$_smarty_tpl->tpl_vars['professionista'] = $foreach_professionista_Sav;
}
?>
        
    </div>
</div><?php }
}
?>