<?php /* Smarty version 3.1.27, created on 2016-06-26 01:27:53
         compiled from "templates\templates\paginaCliente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:24261576f1379161bb0_46106425%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7382afd1e6591ab0ae7f7ec1f1ae65661362714' => 
    array (
      0 => 'templates\\templates\\paginaCliente.tpl',
      1 => 1466891463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24261576f1379161bb0_46106425',
  'variables' => 
  array (
    'nomeUtente' => 0,
    'numID' => 0,
    'nome' => 0,
    'cognome' => 0,
    'dataNascita' => 0,
    'sesso' => 0,
    'codiceFiscale' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576f13791a3a76_85984147',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576f13791a3a76_85984147')) {
function content_576f13791a3a76_85984147 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24261576f1379161bb0_46106425';
?>

<div class='userContainer'>
    
    <h1><?php echo $_smarty_tpl->tpl_vars['nomeUtente']->value;?>
</h1>
    
    <div class="immagine">
        qui dentro ci andrà la foto dell'utente (se vogliamo implementare il caricamento della foto)
    </div>

    <div class="datiUtente">
        <ul>
            <li>ID Utente: <?php echo $_smarty_tpl->tpl_vars['numID']->value;?>
 </li> <br />
            <li>Nome: <?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
 </li>
            <li>Cognome: <?php echo $_smarty_tpl->tpl_vars['cognome']->value;?>
 </li>
            <li>Data di nascita: <?php echo $_smarty_tpl->tpl_vars['dataNascita']->value;?>
 </li>
            <li>Sesso: <?php echo $_smarty_tpl->tpl_vars['sesso']->value;?>
 </li>
            <li>Codice fiscale: <?php echo $_smarty_tpl->tpl_vars['codiceFiscale']->value;?>
 </li>
            <li>Email:<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
 </li>
        </ul>
    </div>

    <div class="Calendario">
        <a href="?controller=calendario&idp=1">Prenota un appuntamento! Clicca per aprire l'agenda di 'Mario Rossi'</a>
    </div>
    
</div>


<?php }
}
?>