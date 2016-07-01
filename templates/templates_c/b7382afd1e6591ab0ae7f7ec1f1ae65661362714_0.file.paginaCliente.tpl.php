<?php /* Smarty version 3.1.27, created on 2016-06-29 22:28:14
         compiled from "templates\templates\paginaCliente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2701257742f5e1b0911_49789406%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7382afd1e6591ab0ae7f7ec1f1ae65661362714' => 
    array (
      0 => 'templates\\templates\\paginaCliente.tpl',
      1 => 1467232091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2701257742f5e1b0911_49789406',
  'variables' => 
  array (
    'numID' => 0,
    'nome' => 0,
    'cognome' => 0,
    'dataNascita' => 0,
    'sesso' => 0,
    'codiceFiscale' => 0,
    'email' => 0,
    'cronologia' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57742f5e205e03_98859444',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57742f5e205e03_98859444')) {
function content_57742f5e205e03_98859444 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2701257742f5e1b0911_49789406';
?>
<link type="text/css" rel="stylesheet" href="View/css/paginaCliente.css" />

<div title="contenitoreUtente"id='contenitoreUtente'>
    
            

            <h2>Pagina Cliente - ID Utente: <?php echo $_smarty_tpl->tpl_vars['numID']->value;?>
 </h2>

            <div title="immagine" id="immagine">
                Carica Immagine
            </div>

            <div title="datiUtente" id="datiUtente">
                
                <ul>
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
                    <li>Email: <?php echo $_smarty_tpl->tpl_vars['email']->value;?>
 </li>
                    <br><br>Altre informazioni...
                </ul>
                
            </div>
            
            
                <h3>Cronologia Appuntamenti </h3>
                <table id="pastAppTable">
                    <tr id="chiavi">
                        <td>Data</td> 
                        <td>Orario</td> 
                        <td>Servizio</td> 
                        <td>Professionista</td>
                    </tr>
                    
                    <?php
$_from = $_smarty_tpl->tpl_vars['cronologia']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['app'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['app']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['app']->value) {
$_smarty_tpl->tpl_vars['app']->_loop = true;
$foreach_app_Sav = $_smarty_tpl->tpl_vars['app'];
?> 
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['app']->value['data'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['app']->value['orario'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['app']->value['nomeServ'];?>
</td>
                            <td><a href=?controller=paginaProfessionista&id=<?php echo $_smarty_tpl->tpl_vars['app']->value['idProf'];?>
 ><?php echo $_smarty_tpl->tpl_vars['app']->value['nomeProf'];?>
 </a></td>
                        </tr>
                    <?php
$_smarty_tpl->tpl_vars['app'] = $foreach_app_Sav;
}
?>
                    
                    <a href=?controller=modificaCliente id="modifica"><button>Modifica informazioni</button></a>
                    
                </table>
            

        </div>


<?php }
}
?>