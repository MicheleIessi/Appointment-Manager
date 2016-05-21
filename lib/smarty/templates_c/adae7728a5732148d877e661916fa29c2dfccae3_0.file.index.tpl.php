<?php /* Smarty version 3.1.27, created on 2016-05-19 17:14:42
         compiled from "E:\DocumentRoot\appointment-manager\templates\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:16820573dd8624a20c9_18014938%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adae7728a5732148d877e661916fa29c2dfccae3' => 
    array (
      0 => 'E:\\DocumentRoot\\appointment-manager\\templates\\index.tpl',
      1 => 1461677251,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16820573dd8624a20c9_18014938',
  'variables' => 
  array (
    'elenco' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_573dd8629eb737_93963588',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_573dd8629eb737_93963588')) {
function content_573dd8629eb737_93963588 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '16820573dd8624a20c9_18014938';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <title>index</title>
  </head>
  <body style="width: 1000px;">
    <p style="width: 1000px; font-size: 65px; vertical-align: 0%; display: inline; font-family: KacstDecorative; color: #339999;">&nbsp;
      APPOINTMENT-MANAGER</p>
    <p style="width: 1000px; font-size: 65px; vertical-align: 0%; display: inline; font-family: KacstDecorative; color: #339999;"><br>
    </p>
    <span style="color: #339999;"><span style="font-family: KacstDecorative;"><br>
        <br>
      </span></span><span style="color: #339999;"><span style="font-family: KacstDecorative;"><br>
      </span></span>
    <table style="width: 1022px; height: 29px;" border="1" cellpadding="4" cellspacing="0%%%">
      <tbody>
        <tr>
          <td style="width: 333px; height: 29px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="View/login.php">
              Login o Registrazione</a></td>
          <td style="width: 33%; height: 29px; text-align: center;">Cerca</td>
          <td style="text-align: center;">About</td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <br>
    <table style="width: 500px; height: 180px; text-align: left; margin-left: 0px; margin-right: 0px;"
      border="1" cellspacing="0">
      <tbody>
        <tr>
          <td style="width: 500px; height: 180px; text-align: left; vertical-align: top;"><?php echo $_smarty_tpl->tpl_vars['elenco']->value;?>

            </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
<?php }
}
?>