<?php /* Smarty version 3.1.27, created on 2016-07-04 16:29:34
         compiled from "templates\templates\colonnaInformazioni.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:16539577a72ced6c6d7_78281340%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23c58634159a53470de1374ac5eefdf769f823ca' => 
    array (
      0 => 'templates\\templates\\colonnaInformazioni.tpl',
      1 => 1467580892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16539577a72ced6c6d7_78281340',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577a72ceda2d25_76666813',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577a72ceda2d25_76666813')) {
function content_577a72ceda2d25_76666813 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '16539577a72ced6c6d7_78281340';
?>
<div id='wrapServizi'>
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