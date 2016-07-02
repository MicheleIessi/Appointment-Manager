<?php /* Smarty version 3.1.27, created on 2016-07-02 12:53:13
         compiled from "templates\templates\colonna_servizi.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3014557779d1925e770_85774337%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1281743a12198de32af4628fdff664925b2551df' => 
    array (
      0 => 'templates\\templates\\colonna_servizi.tpl',
      1 => 1467456790,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3014557779d1925e770_85774337',
  'variables' => 
  array (
    'servizi' => 0,
    'servizio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57779d192d2ef1_91483016',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57779d192d2ef1_91483016')) {
function content_57779d192d2ef1_91483016 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3014557779d1925e770_85774337';
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