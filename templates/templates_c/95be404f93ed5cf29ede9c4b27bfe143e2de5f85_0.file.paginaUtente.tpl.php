<?php /* Smarty version 3.1.27, created on 2016-06-25 23:51:24
         compiled from "templates\templates\paginaUtente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:5208576efcdc17cf81_48084879%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95be404f93ed5cf29ede9c4b27bfe143e2de5f85' => 
    array (
      0 => 'templates\\templates\\paginaUtente.tpl',
      1 => 1466891463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5208576efcdc17cf81_48084879',
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
  'unifunc' => 'content_576efcdc1c7fe5_18149391',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576efcdc1c7fe5_18149391')) {
function content_576efcdc1c7fe5_18149391 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5208576efcdc17cf81_48084879';
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