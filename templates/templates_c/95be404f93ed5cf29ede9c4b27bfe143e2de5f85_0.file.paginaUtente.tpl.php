<?php /* Smarty version 3.1.27, created on 2016-06-24 15:56:24
         compiled from "templates\templates\paginaUtente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:24092576d3c08578010_99918556%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95be404f93ed5cf29ede9c4b27bfe143e2de5f85' => 
    array (
      0 => 'templates\\templates\\paginaUtente.tpl',
      1 => 1466776547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24092576d3c08578010_99918556',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576d3c085aa635_16827905',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576d3c085aa635_16827905')) {
function content_576d3c085aa635_16827905 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24092576d3c08578010_99918556';
?>
<div class='userContainer'>
  <h1>'Mario Rossi'</h1>
  <p>
    Questo è il profilo di 'Mario Rossi' (questo è un paragrafo di prova)
  </p>
  <div class="immagine">
    qui dentro ci andrà la foto dell'utente (se vogliamo implementare il caricamento della foto)
  </div>
  
  <div class="datiUtente">
    qui dentro andranno i dati dell'utente, per esempio:<br><br> Nome:<br>Cognome:<br>Data di nascita:<br>
    Email:<br><br>e così via. (implementazione come tabella?)
  </div>
  
  <div class="Calendario">
    <a href="?controller=calendario&idp=1">Prenota un appuntamento! Clicca per aprire l'agenda di 'Mario Rossi'</a>
  </div>
</div>


<?php }
}
?>