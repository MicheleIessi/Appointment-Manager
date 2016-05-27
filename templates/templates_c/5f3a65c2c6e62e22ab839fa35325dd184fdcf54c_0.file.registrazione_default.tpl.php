<?php /* Smarty version 3.1.27, created on 2016-05-27 22:05:52
         compiled from "templates\templates\registrazione_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:323165748a8a0d71910_32034034%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f3a65c2c6e62e22ab839fa35325dd184fdcf54c' => 
    array (
      0 => 'templates\\templates\\registrazione_default.tpl',
      1 => 1464379550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '323165748a8a0d71910_32034034',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5748a8a0db3313_05783145',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5748a8a0db3313_05783145')) {
function content_5748a8a0db3313_05783145 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '323165748a8a0d71910_32034034';
?>
<a id="anchor-login-4"></a>
<div class="corner-subcontent-top"></div>
<div class="subcontent-box">
    <h1 class="login">Login</h1>
    <div class="loginform">
        <br />
        <form method="post" action="index.php">
            <p><input type="hidden" name="rememberme" value="0" /></p>
            <p><input type="hidden" name="controller" value="registrazione" /></p>
            <p><input type="hidden" name="task" value="autentica" /></p>
            <fieldset>
                <p><label for="username" class="top">Nome utente:</label><br />
                    <input type="text" name="username" id="username" tabindex="1" class="field" value="" /></p>
                <p><label for="password" class="top">Password:</label><br />
                    <input type="password" name="password" id="password" tabindex="2" class="field" value="" /></p>
                <p><input type="checkbox" name="checkbox" id="checkbox" class="checkbox" tabindex="3" size="1" value="" /><label for="checkbox" class="right">Ricordati?</label></p>
                <p><input type="submit" name="cmdweblogin" class="button" value="LOGIN"  /></p>
                <p><a href="?controller=autenticazione&task=password_dimenticata" id="forgotpsswd">Password dimenticata?</a></p>
            </fieldset>
        </form>
    </div>
</div>
<div class="corner-subcontent-bottom"></div><?php }
}
?>