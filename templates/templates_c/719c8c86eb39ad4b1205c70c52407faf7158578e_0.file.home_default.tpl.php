<?php /* Smarty version 3.1.27, created on 2016-06-26 12:50:37
         compiled from "templates\templates\home_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10718576fb37d30ed49_04085655%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '719c8c86eb39ad4b1205c70c52407faf7158578e' => 
    array (
      0 => 'templates\\templates\\home_default.tpl',
      1 => 1466938167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10718576fb37d30ed49_04085655',
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
  'unifunc' => 'content_576fb37d381ba9_88555467',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576fb37d381ba9_88555467')) {
function content_576fb37d381ba9_88555467 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10718576fb37d30ed49_04085655';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
        <link type="text/css" rel="stylesheet" href='View/css/prova.css' />
        <link type="text/css" rel="stylesheet" href="View/css/login.css" />
        <link type="text/css" rel="stylesheet" href="View/css/paginaCliente.css" />
        <link type="text/css" rel="stylesheet" href="View/css/paginaProfessionista.css" />
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'><?php echo '</script'; ?>
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
    <?php echo $_smarty_tpl->tpl_vars['banner']->value;?>

    <!-- MAIN BUTTONS -->
    <?php $_smarty_tpl->tpl_vars['nolog'] = new Smarty_Variable(false, null, 0);?>
    <div class="wrapper">
        <div class ="mainButtons">
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
                <a class='buttonElem' href="<?php echo $_smarty_tpl->tpl_vars['button']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['button']->value['testo'];?>
</a>
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
                <form action="phpperlogin">
                    <div class="txt-fld">
                        <label for="">Email</label>
                        <input id="" name="" type="text">
                    </div>
                    <div class="txt-fld">
                        <label for="">Password</label>
                        <input id="" name="" type="password">

                    </div>
                    <div class="btn-fld">
                        <button type="submit">Login »</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="registrazionemodal">
            <div id="signup-ct">
                <div id="signup-header">
                    <h2>Creazione account</h2>
                    <p>&Egrave; facile e veloce.</p>
                    <a class="modal_close" href="#"></a>
                </div>
                <form action="phpperregistrazione">
                    <div class="txt-fld">
                        <label for="">Nome</label>
                        <input id="" name="" type="text">
                    </div>
                    <div class="txt-fld">
                        <label for="">Cognome</label>
                        <input id="" name="" type="text">
                    </div>
                    <div class="txt-fld">
                        <label for="">Email</label>
                        <input id="EmailReg" name="EmailReg" type="text">
                    </div>
                    <div class="txt-fld">
                        <label for="">Data di nascita</label>
                        <input id="" name="" type="date">
                    </div>
                    <div class="txt-fld">
                        <label for="">Password</label>
                        <input id="" name="" type="password">

                    </div>
                    <div class="btn-fld">
                        <button type="submit">Registrati »</button>
                    </div>
                </form>
            </div>
        </div>
    <?php }?>
    <div class ="main">
        <!-- MAIN CONTENT -->
        <div class='content'>
            <?php echo $_smarty_tpl->tpl_vars['main_content']->value;?>

        </div>
        <!-- SIDE CONTENT -->
        <?php if ($_smarty_tpl->tpl_vars['right_content']->value) {?>
            <div class="side_content">
                <?php echo $_smarty_tpl->tpl_vars['right_content']->value;?>

            </div>
        <?php }?>
        </div>
    </body>
</html><?php }
}
?>