<?php /* Smarty version 3.1.27, created on 2016-07-04 13:16:46
         compiled from "templates\templates\colonnaCancellazione.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:6845577a459e6d1489_31219639%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6db30c6b8a5a3d4607ecde3402a5d2c87535d6c9' => 
    array (
      0 => 'templates\\templates\\colonnaCancellazione.tpl',
      1 => 1467580892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6845577a459e6d1489_31219639',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577a459e703733_97420798',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577a459e703733_97420798')) {
function content_577a459e703733_97420798 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '6845577a459e6d1489_31219639';
?>
<div id='wrapServizi'>
    <p>Stai guardando la tua agenda</p>
    <p id="dettagli"></p>
    <div id='external-events'>
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

</div><?php }
}
?>