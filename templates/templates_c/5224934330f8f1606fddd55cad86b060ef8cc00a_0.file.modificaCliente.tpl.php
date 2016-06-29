<?php /* Smarty version 3.1.27, created on 2016-06-30 00:03:42
         compiled from "templates\templates\modificaCliente.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:21869577445bedc1997_70179597%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5224934330f8f1606fddd55cad86b060ef8cc00a' => 
    array (
      0 => 'templates\\templates\\modificaCliente.tpl',
      1 => 1467237515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21869577445bedc1997_70179597',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577445bedfc046_78883269',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577445bedfc046_78883269')) {
function content_577445bedfc046_78883269 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '21869577445bedc1997_70179597';
?>
<link type="text/css" rel="stylesheet" href="View/css/modificaCliente.css" />


<div id="contenitoreForm">
        
        <h1>Modifica informazioni</h1>
        
        <form name="modificaCliente" action="modificaCliente.php" method="post">
            
            <table>
                    <tr>
                        <td>Nome</td>
                        <td> <input type="text" id="nome" required></td>
                    </tr>

                    <tr>
                        <td>Cognome</td>
                        <td> <input type="text" id="cognome" required></td>
                    </tr>

                    <tr>
                        <td>Data di nascita</td>
                        <td> <input type=date id="dataNascita" required></td>
                    </tr>

                    <tr>
                        <td>Sesso</td>
                        <td> M<input type="radio" id="maschio"> F<input type="radio" id="femmina"></td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td> <input type="text" id="email" required></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td> <input type="password" id="password1" required></td>
                    </tr>

                    <tr>
                        <td>Conferma Password</td>
                        <td> <input type="password" id="password2" required></td>
                    </tr>

                    <tr>
                        <td><input type=submit id="submit" value="Applica cambiamenti"><td/>
                    </tr>

                </table>

        </form>
    </div><?php }
}
?>