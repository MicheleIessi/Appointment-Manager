<?php /* Smarty version 3.1.27, created on 2016-07-04 20:48:40
         compiled from "templates\templates\setup.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:23345577aaf88336b13_74416814%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '546f73fb708e7ac1d19f73f52de21a98e2af4947' => 
    array (
      0 => 'templates\\templates\\setup.tpl',
      1 => 1467658117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23345577aaf88336b13_74416814',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_577aaf88391c94_20699126',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_577aaf88391c94_20699126')) {
function content_577aaf88391c94_20699126 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '23345577aaf88336b13_74416814';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <link  type="text/css" href="View/css/setup.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Setup</title>
</head>
<body>
<form method="post" action="index.php">
    <div id='content'>
        <div id="box_c">
            <br>
            <p id="title">Riassunto dati</p>
            <br><br>
            <div class="setup_data">
                <div id="admin_data" class="floatLeft data">
                    <div>Informazioni relative all'admin</div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Nome: </div>
                        <input type="text" class='floatRight f_admin_data f_data' id="name_admin_f" name="name_admin" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Cognome: </div>
                        <input type="text" class='floatRight f_admin_data f_data' id="surname_admin_f" name="surname_admin" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Indirizzo email: </div>
                        <input type="text" class='floatRight f_admin_data f_data' id="email_admin_f" name="email_admin" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Password: </div>
                        <input type="password" class='floatRight f_admin_data f_data' id="password_admin_f" name="password_admin" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Conferma password: </div>
                        <input type="password" class='floatRight f_admin_data f_data' id="r_password_admin_f" name="r_password_admin" disabled/>
                    </div>
                    <br><br>
                </div>
                <div id="site_data" class="floatRight data">
                    <div>Informazioni relative al sito.</div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Nome del sito: </div>
                        <input type="text" class='floatRight f_site_data f_data' id="site_name_f" name="site_name" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">URL dove &egrave collocata l'applicazione: </div>
                        <input type="text" class='floatRight f_site_data f_data' id="site_url_f" name="site_url" disabled/>
                    </div>
                    <br><br>
                </div>
                <div class="clear"></div>
            </div>
            <br><br>
            <div class="setup_data">
                <div id="mail_data" class="floatLeft data">
                    <div>Informazioni relative all'indirizzo email del sito. [Utilizzata per l'invio di mail di supporto agli utenti]</div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Indirizzo email: </div>
                        <input type="text" class='floatRight f_mail_data f_data' id="site_mail_f" name="site_mail" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Password dell'indirizzo email: </div>
                        <input type="password" class='floatRight f_mail_data f_data' id="site_mail_password_f" name="site_mail_password" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Server SMTP: </div>
                        <input type="text" class='floatRight f_mail_data f_data' id="site_mail_smtp_f" name="site_mail_smtp" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Porta del server SMTP: </div>
                        <input type="text" class='floatRight f_mail_data f_data' id="site_mail_smtp_port_f" name="site_mail_smtp_port" disabled/>
                    </div>
                    <br><br>
                </div>
                <div id="dbms_data" class="floatRight data">
                    <div>Informazioni relative al DBMS</div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Nome del DBMS: </div>
                        <input type="text" class='floatRight f_dbms_data f_data' id="dbms_name_f" name="dbms_name" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">User DBMS: </div>
                        <input type="text" class='floatRight f_dbms_data f_data' id="dbms_user_f" name="dbms_user" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Password user DBMS: </div>
                        <input type="password" class='floatRight f_dbms_data f_data' id="dbms_password_f" name="dbms_password" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Nome desiderato per il DB: </div>
                        <input type="text" class='floatRight f_dbms_data f_data' id="dbms_dbname_f" name="dbms_dbname" disabled/>
                    </div>
                    <br><br>
                    <div>
                        <div class="floatLeft">Indirizzo IP DB: </div>
                        <input type="text" class='floatRight f_dbms_data f_data' id="dbms_ip_f" name="dbms_ip" disabled/>
                    </div>
                    <br><br>
                </div>
                <div class="clear"></div>
            </div>
            <br><br>
            <div>
                <input type="button" id="send_setup" class="button floatLeft buttons_setup" value="Invia">
                <input type='button' class='button floatRight buttons_setup' value='Modifica' id='modify_setup'>
            </div>
            <input type="hidden" name="task" value="setup">
        </div>
    </div>
</form></body>
</html>
<?php }
}
?>