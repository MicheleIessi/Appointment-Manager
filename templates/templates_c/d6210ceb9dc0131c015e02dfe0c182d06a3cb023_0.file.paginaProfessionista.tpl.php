<?php /* Smarty version 3.1.27, created on 2016-06-26 15:30:04
         compiled from "templates\templates\paginaProfessionista.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10175576fd8dcb6ca93_04273746%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6210ceb9dc0131c015e02dfe0c182d06a3cb023' => 
    array (
      0 => 'templates\\templates\\paginaProfessionista.tpl',
      1 => 1466938684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10175576fd8dcb6ca93_04273746',
  'variables' => 
  array (
    'nomeUtente' => 0,
    'settore' => 0,
    'numID' => 0,
    'nome' => 0,
    'cognome' => 0,
    'dataNascita' => 0,
    'sesso' => 0,
    'codiceFiscale' => 0,
    'email' => 0,
    'lun' => 0,
    'mar' => 0,
    'mer' => 0,
    'gio' => 0,
    'ven' => 0,
    'sab' => 0,
    'dom' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576fd8dcbc43e6_00679496',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576fd8dcbc43e6_00679496')) {
function content_576fd8dcbc43e6_00679496 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10175576fd8dcb6ca93_04273746';
?>
<div class='userContainer'>

            <h1><?php echo $_smarty_tpl->tpl_vars['nomeUtente']->value;?>
</h1>
            
            <p>
                <?php echo $_smarty_tpl->tpl_vars['settore']->value;?>

            </p>
            
            <div class="immagine">
                qui dentro ci andrà la foto dell'utente (se vogliamo implementare il caricamento della foto)
            </div>

            <div class="datiUtente">
                <br />
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
                    <li>Settore:<?php echo $_smarty_tpl->tpl_vars['settore']->value;?>
 </li>
                </ul> 
            </div>
            
            <div class="orariLavoro">
                <table>
                    
                    <tr>
                        <td>Lunedì</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['lun']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Martedì</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['mar']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Mercoledì</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['mer']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Giovedì</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['gio']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Venerdì</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['ven']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Sabato</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['sab']->value;?>
 </td>
                    </tr>
                    
                    <tr>
                        <td>Domenica</td>
                        <td> <?php echo $_smarty_tpl->tpl_vars['dom']->value;?>
 </td>
                    </tr>
                    
                </table>
            </div>
            
            <div class="Calendario">
                <a href="?controller=calendario&idp=<?php echo $_smarty_tpl->tpl_vars['numID']->value;?>
">Prenota un appuntamento! Clicca per aprire l'agenda di <?php echo $_smarty_tpl->tpl_vars['nomeUtente']->value;?>
</a>
            </div>

        </div><?php }
}
?>