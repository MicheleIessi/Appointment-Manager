<?php /* Smarty version 3.1.27, created on 2016-07-06 10:44:03
         compiled from "templates\templates\colonna_servizi.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:31561577cc4d3a20dd1_97570109%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1281743a12198de32af4628fdff664925b2551df' => 
    array (
      0 => 'templates\\templates\\colonna_servizi.tpl',
      1 => 1467794419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31561577cc4d3a20dd1_97570109',
  'variables' => 
  array (
    'nomeProf' => 0,
    'servizi' => 0,
    'servizio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577cc4d3a7f292_39798682',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577cc4d3a7f292_39798682')) {
function content_577cc4d3a7f292_39798682 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '31561577cc4d3a20dd1_97570109';
?>
<div id='wrapServizi'>
    <p>Agenda di <?php echo $_smarty_tpl->tpl_vars['nomeProf']->value;?>
:</p>
    <p id="dettagli"></p>
    <div id='external-events'>
        <div id="loadingDiv">
            <img id="loadingGif" src="img/loading.gif" />
        </div>
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
            <div class='fc-event' style='z-index: auto' data-event='{"title":"<?php echo $_smarty_tpl->tpl_vars['servizio']->value['nome'];?>
"}' data-duration="<?php echo $_smarty_tpl->tpl_vars['servizio']->value['durata'];?>
"><?php echo $_smarty_tpl->tpl_vars['servizio']->value['nome'];?>
</div>
        <?php
$_smarty_tpl->tpl_vars['servizio'] = $foreach_servizio_Sav;
}
?>
        <div id='bottoneCestino'>
            <button id="mostraCestino">Modifica appuntamenti</button>
            <p>Ricorda che non puoi annullare appuntamenti presi che avverranno tra meno di due giorni</p>
        </div>

    </div>
    <div class="cestinoNascosto">
        <div id="calendarTrash" class="calendar-trash">
            <img id='immCestino' src="img/trash-512.png"/>
            <button id="fineModifica">Ho finito</button>
        </div>
    </div>
</div>
<?php }
}
?>