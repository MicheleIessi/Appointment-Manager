<?php /* Smarty version 3.1.27, created on 2016-07-02 14:46:24
         compiled from "templates\templates\modificaCliente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:236885777b7a0403696_08636338%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5224934330f8f1606fddd55cad86b060ef8cc00a' => 
    array (
      0 => 'templates\\templates\\modificaCliente.tpl',
      1 => 1467463575,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236885777b7a0403696_08636338',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5777b7a04387b5_60485209',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5777b7a04387b5_60485209')) {
function content_5777b7a04387b5_60485209 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '236885777b7a0403696_08636338';
?>
<link type="text/css" rel="stylesheet" href="View/css/modificaCliente.css" />
<link type="text/css" rel="stylesheet" href="View/css/jquery-ui.css" />

<?php echo '<script'; ?>
 type="text/javascript" src='JS/validation/dateITA.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/modificaCliente.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/jquery-ui.min.js'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src='JS/datepicker-it.js'><?php echo '</script'; ?>
>

<div id="contenitoreForm">

    <h1>Modifica informazioni</h1>

    <form name="modificaCliente" id="modificaCliente" method="post" action="controllaForm.php">

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
                <td><input type="submit" value=" INVIA "><td/>
            </tr>

        </table>

    </form>
</div><?php }
}
?>