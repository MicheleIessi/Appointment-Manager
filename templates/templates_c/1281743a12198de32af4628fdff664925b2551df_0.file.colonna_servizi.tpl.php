<?php /* Smarty version 3.1.27, created on 2016-07-03 23:20:17
         compiled from "templates\templates\colonna_servizi.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:9965577981917b0344_38819663%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1281743a12198de32af4628fdff664925b2551df' => 
    array (
      0 => 'templates\\templates\\colonna_servizi.tpl',
      1 => 1467468758,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9965577981917b0344_38819663',
  'variables' => 
  array (
    'servizi' => 0,
    'servizio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577981917fbcb0_02719414',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577981917fbcb0_02719414')) {
function content_577981917fbcb0_02719414 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '9965577981917b0344_38819663';
?>
<div id='wrapServizi'>
    <div id='external-events'>
        <h4>Servizi disponibili:</h4>
        <?php
$_from = $_smarty_tpl->tpl_vars['servizi']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['servizio'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['servizio']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['servizio']->value) {
$_smarty_tpl->tpl_vars['servizio']->_loop = true;
$foreach_servizio_Sav = $_smarty_tpl->tpl_vars['servizio'];
?>
            <div class='fc-event' data-event='{"title":"<?php echo $_smarty_tpl->tpl_vars['servizio']->value['nome'];?>
"}' data-duration="<?php echo $_smarty_tpl->tpl_vars['servizio']->value['durata'];?>
"><?php echo $_smarty_tpl->tpl_vars['servizio']->value['nome'];?>
</div>
        <?php
$_smarty_tpl->tpl_vars['servizio'] = $foreach_servizio_Sav;
}
?>
        <div id='bottoneCestino'>
            <button id="mostraCestino">Modifica appuntamenti</button>
        </div>

    </div>
    <div class="cestinoNascosto">
        <div id='cestino'>
            <img id='immCestino' src="img/trash-512.png"/>
            <button id="fineModifica">Ho finito</button>
        </div>
    </div>

</div><?php }
}
?>