<?php /* Smarty version 3.1.27, created on 2016-07-07 13:08:02
         compiled from "templates\templates\home_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14019577e3812e382d2_12477207%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '719c8c86eb39ad4b1205c70c52407faf7158578e' => 
    array (
      0 => 'templates\\templates\\home_default.tpl',
      1 => 1467889670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14019577e3812e382d2_12477207',
  'variables' => 
  array (
    'title' => 0,
    'banner' => 0,
    'mainButtons' => 0,
    'button' => 0,
    'nolog' => 0,
    'main_content' => 0,
    'right_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577e38131ac943_74730498',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577e38131ac943_74730498')) {
function content_577e38131ac943_74730498 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14019577e3812e382d2_12477207';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link type="text/css" rel="stylesheet" href='View/css/prova.css' />
        <link type="text/css" rel="stylesheet" href="View/css/login.css" />
        <link type="text/css" rel="stylesheet" href="View/css/jquery-ui.css" />
        
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="JS/validation/jquery.validate.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/jquery-ui/jquery-ui.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/fullcalendar.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lang-all.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/JCalendar.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="JS/jquery.leanModal.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="JS/JLogin.js"><?php echo '</script'; ?>
>
        
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
    <!-- BANNER -->
    <!-- MAIN BUTTONS -->
    <?php $_smarty_tpl->tpl_vars['nolog'] = new Smarty_Variable(false, null, 0);?>
    
    <div id="wrapper">
        <div id ="mainButtons">
            <?php echo $_smarty_tpl->tpl_vars['banner']->value;?>

            <?php
$_from = $_smarty_tpl->tpl_vars['mainButtons']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['button'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['button']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['button']->value) {
$_smarty_tpl->tpl_vars['button']->_loop = true;
$foreach_button_Sav = $_smarty_tpl->tpl_vars['button'];
?>
                <?php if ($_smarty_tpl->tpl_vars['button']->value['testo'] == 'Login' || $_smarty_tpl->tpl_vars['button']->value['testo'] == 'Registrati') {?>
                    <?php $_smarty_tpl->tpl_vars['nolog'] = new Smarty_Variable(true, null, 0);?>
                    <a class='buttonElem' rel="leanModal" href="<?php echo $_smarty_tpl->tpl_vars['button']->value['link'];?>
" id="modaltrigger"><?php echo $_smarty_tpl->tpl_vars['button']->value['testo'];?>
</a>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['button']->value['testo'] == 'Logout') {?>
                        <a class='buttonElem' id="bottoneLogout" href="<?php echo $_smarty_tpl->tpl_vars['button']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['button']->value['testo'];?>
</a>
                    <?php } else { ?>
                        <a class='buttonElem' href="<?php echo $_smarty_tpl->tpl_vars['button']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['button']->value['testo'];?>
</a>
                    <?php }?>
                <?php }?>
            <?php
$_smarty_tpl->tpl_vars['button'] = $foreach_button_Sav;
}
?>
        </div>
    </div>
    
    <?php if ($_smarty_tpl->tpl_vars['nolog']->value) {?> <!-- L'utente corrente non è loggato o non è registrato. Sono quindi presenti i div relativi a login e registrazione con leanmodal-->
        <div id="loginmodal">
            <div id="signup-ct">
                <div id="signup-header">
                    <h2>Login Utente</h2>
                    <p>Sei già iscritto? Effettua il login.</p>
                    <a class="modal_close" href="#"></a>
                </div>
                <form id='loginForm' method='post' action="Control/Ajax/ALogin.php?task=login">
                    <table id="campi">
                        <tr class="tableElem">
                            <td class="desc">Email</td>
                            <td><div class="txt-fld">
                                    <input type="text" name="email" id="email" >
                                </div>
                            </td>
                        </tr>

                        <tr class="tableElem">
                            <td class="desc">Password</td>
                            <td><div class="txt-fld">
                                    <input type="password" name="password" id="pass" >
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="btn-fld">
                        <button id="bottoneLogin">Login »</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="registrazionemodal">
                <tr id="signup-header">
                    <h2>Creazione account</h2>
                    <p>&Egrave; facile e veloce.</p>
                    <a class="modal_close" href="#"></a>
                </tr>
                <form id='RegisterForm' method="post" action="Control/Ajax/ALogin.php?task=reg">
                    <table>
                    <tr class="tableElem">
                        <td class="desc">Nome</td>
                        <td><div class="txt-fld">
                            <input  type="text"name="Nome" >
                        </div>   
                    </tr>
                    <tr class="tableElem">
                        <td class="desc">Cognome</td>
                        <td><div class="txt-fld">
                             <input  type="text"name="Cognome" >
                            </div>   
                    </tr>
                    <tr class="tableElem">
                        <td class="desc">Codice Fiscale</td>
                        <td><div class="txt-fld">
                             <input  id="codiceFiscale" type="text"name="CodiceFiscale" >
                            </div>   
                    </tr>
                    <tr class="tableElem">
                        <td class="desc">Email Registrazione</td>
                        <td><div class="txt-fld">
                             <input id="emailreg" type="text"name="email" >
                            </div>    
                    </tr>
                    <tr class="tableElem">
                        <td class="desc">Data Nascita</td>
                        <td><div class="txt-fld">
                        <input  id="datepicker" type="text" name="Data" >
                            </div>
                    </tr>
                    <tr class="legend">
                        <td class="desc" >Sesso</td>
                        <td>maschio<input type="radio"name="Sesso" value="m" checked>femmina<input type="radio"name="Sesso" value="f">
                    </tr>    
                    <tr class="tableElem">
                        <td class="desc">Password</td>
                        <td><div class="txt-fld">
                        <input  type="password" name="Password" id="Password" >
                    </tr>
                    <tr class="tableElem">
                         <td class="desc">Ripeti Password</td>
                        <td><div class="txt-fld">
                        <input  type="password"name="RPassword" >
                    </tr>
                    </table>
                    <tr class="btn-fld">
                        <button type="bottoneReg">Registrati »</button>
                    </tr>  
                </form>
        </div>
    <?php }?>
    <div class ="main">
        <!-- MAIN CONTENT -->
        <?php echo $_smarty_tpl->tpl_vars['main_content']->value;?>

        
        <!-- SIDE CONTENT -->
        <?php if ($_smarty_tpl->tpl_vars['right_content']->value) {?>
            <div id="side_content">
                <?php echo $_smarty_tpl->tpl_vars['right_content']->value;?>

            </div>
        <?php }?>
        </div>
    </body>
</html>
<?php }
}
?>