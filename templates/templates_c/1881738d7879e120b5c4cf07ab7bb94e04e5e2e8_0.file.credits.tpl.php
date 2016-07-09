<?php /* Smarty version 3.1.27, created on 2016-07-09 19:40:07
         compiled from "templates\templates\credits.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:12633578136f7ea5f48_72647128%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1881738d7879e120b5c4cf07ab7bb94e04e5e2e8' => 
    array (
      0 => 'templates\\templates\\credits.tpl',
      1 => 1468085904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12633578136f7ea5f48_72647128',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578136f7ed8cd6_15571912',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578136f7ed8cd6_15571912')) {
function content_578136f7ed8cd6_15571912 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '12633578136f7ea5f48_72647128';
?>
<link rel="stylesheet" type="text/css" href="View/css/credits.css">
<p class="grande">Questa applicazione utilizza i seguenti plugins:</p>
<div id="contenitoreCredits">
    <div id="wrapperCredits">
        <div class="box"><a target="_blank" href="https://jquery.com/"><img class="creditsImm" src="img/Logo_JQuery.png" /></a></div>
        <div class="box"><a target="_blank" href="https://jqueryui.com/"><img class="creditsImm" src="img/Logo_JQueryUI.png" /></a></div>
        <div class="box"><a target="_blank" href="http://fullcalendar.io/"><img class="creditsImm" src="img/Logo_FullCalendar.gif" /></a></div>
        <div class="box"><a target="_blank" href="https://jqueryvalidation.org/"><img class="creditsImm" src="img/Logo_Validate.png" /></a></div>
        <div class="box"><a target="_blank" href="http://leanmodal.finelysliced.com.au/"><img class="creditsImm" src="img/Logo_LeanModal.png" /></a></div>
    </div>
</div><?php }
}
?>