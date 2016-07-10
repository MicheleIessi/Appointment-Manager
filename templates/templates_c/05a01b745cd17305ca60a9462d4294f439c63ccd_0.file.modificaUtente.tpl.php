<?php /* Smarty version 3.1.27, created on 2016-07-06 13:03:27
         compiled from "templates\templates\modificaUtente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:24676577ce57f5acf97_59879612%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05a01b745cd17305ca60a9462d4294f439c63ccd' => 
    array (
      0 => 'templates\\templates\\modificaUtente.tpl',
      1 => 1467803000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24676577ce57f5acf97_59879612',
  'variables' => 
  array (
    'messaggio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577ce57f5f3365_46093529',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577ce57f5f3365_46093529')) {
function content_577ce57f5f3365_46093529 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24676577ce57f5acf97_59879612';
?>
<link type="text/css" rel="stylesheet" href="../../css/modificaUtente.css" />

<?php echo '<script'; ?>
 type="text/javascript" src='JS/validation/dateITA.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/modificaUtente.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/jquery-ui/jquery-ui.min.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/jquery-ui/datepicker-it.js'><?php echo '</script'; ?>
>

<div id="contenitoreForm">

    <h1>Modifica informazioni</h1>

    <form name="modificaUtente" id="modificaUtente" method="post" action="modificaUtente.php">

        <table>

            <tr>
                <td>Nome</td>
                <td> <input type="text" name="nome" id="nome" ></td>
            </tr>

            <tr>
                <td>Cognome</td>
                <td> <input type="text" name="cognome" id="cognome" ></td>
            </tr>

            <tr>
                <td>Data di nascita</td>
                <td> <input type=text name="dataNascita" id="datepicker" ></td>
            </tr>
            
            <tr>
                <td>Codice fiscale</td>
                <td> <input type=text name="codiceFiscale" id="codiceFiscale" ></td>
            </tr>

            <tr>
                <td>Sesso</td>
                <td> M<input type="radio" name="sesso" id="maschio" value="M" checked> F<input type="radio" name="sesso" id="femmina" value="F"></td>
            </tr>

            <tr>
                <td>Email</td>
                <td> <input type="text" name="email" id="email" ></td>
            </tr>

            <tr>
                <td>Password</td>
                <td> <input type="password" name="password1" id="password1" ></td>
            </tr>

            <tr>
                <td>Conferma Password</td>
                <td> <input type="password" name="password2" id="password2" ></td>
            </tr>

            <tr>
                <td><input id="submit" type="submit" value=" INVIA "><td/>
            </tr>

        </table>
            
    </form>
    
    <?php if ($_smarty_tpl->tpl_vars['messaggio']->value) {?>
        <label><?php echo $_smarty_tpl->tpl_vars['messaggio']->value;?>
</label>
    <?php }?>

</div><?php }
}
?>