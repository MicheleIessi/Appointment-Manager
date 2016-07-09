<?php /* Smarty version 3.1.27, created on 2016-07-09 19:38:44
         compiled from "templates\templates\home_default_content.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17405578136a49db812_87455965%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f390a344c243660a9118c685019da4fc138b3a' => 
    array (
      0 => 'templates\\templates\\home_default_content.tpl',
      1 => 1468085904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17405578136a49db812_87455965',
  'variables' => 
  array (
    'nome' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578136a4a29856_29004608',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578136a4a29856_29004608')) {
function content_578136a4a29856_29004608 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17405578136a49db812_87455965';
?>
<div id="contenutoDefault">
    <h1 class="titolo">Appointment Manager</h1>
    <p>Benvenuto, <?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
.</p>
    <p>Appointment Manager è un'applicazione per la prenotazione e la gestione di appuntamenti.</p>
    <h3>Pronto a cominciare?</h3>
    <?php if ($_smarty_tpl->tpl_vars['nome']->value == "ospite") {?>
        <a href="#registrazionemodal" rel="leanmodal" id="modaltrigger"><button>Registrati!</button></a>
    <?php } else { ?>
        <a href="?controller=lista&task=lista"><button>Lista professionisti</button></a>

    <?php }?>
</div><?php }
}
?>