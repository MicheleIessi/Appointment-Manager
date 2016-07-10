<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Appointment manager setup</title>
    <link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/setup.css" />
    <script type="text/javascript" src="JS/fullcalendar-2.6.1/lib/jquery.min.js"></script>
    <script type="text/javascript" src="JS/validation/jquery.validate.js"></script>
    <script type="text/javascript" src="JS/JSetup.js"></script>
    <script type="text/javascript" src="JS/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="JS/jquery-ui/datepicker-it.js"></script>



</head>
<body>
<h1>APPOINTMENT-MANAGER</h1>
<h3>Questo setup configurerà automaticamente la tua installazione.</h3>
<div class='tableHolder'>
    <h2>INIZIALIZZAZIONE ACCOUNT AMMINISTRATORE</h2>
    <form id="setupForm" action="index.php" method="post">
        <table id='adminInfo' title="Dati amministratore">
            <caption>Informazioni anagrafiche</caption>
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" placeholder="Nome amministratore" name="nomeAdmin"/></td>
                </tr>
                <tr>
                    <td>Cognome:</td>
                    <td><input type="text" placeholder="Cognome amministratore" name="cognomeAdmin"/></td>
                </tr>
                <tr>
                    <td>Data di nascita:</td>
                    <td><input type="text" id="dataNascitaAdmin" placeholder="Data di nascita" name="dataNascitaAdmin"></td>
                </tr>
                <tr>
                    <td>Codice fiscale:</td>
                    <td><input type="text" name="codiceFiscaleAdmin" placeholder="Codice fiscale amministratore"/></td>
                </tr>
                <tr>
                    <td>Sesso:</td>
                    <td><label for="radioM">M<input type="radio" id="radioM" name="sessoAdmin" value="M" checked ></label>
                        <label for="radioF">F<input id="radioF" type="radio" name="sessoAdmin" value="F" ></label></td>

                </tr>
                <caption>Informazioni di registrazione</caption>
                <tr>
                    <td>Indirizzo E-Mail:</td>
                    <td><input type="text" name="emailAdmin" placeholder="E-Mail amministratore"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password1" name="passwordAdmin1" placeholder="Password" /></td>
                </tr>
                <tr>
                    <td>Ripeti password:</td>
                    <td><input type="password" name="passwordAdmin2" placeholder="Ripeti password"/></td>
                </tr>
        </table>
        <h2>INIZIALIZZAZIONE CONFIGURAZIONE</h2>
        <table id='configInfo' title='Configurazione db e mail'>
            <caption>Informazioni Database</caption>
            <tr>
                <td>Nome del DBMS:</td>
                <td><input type="text" id="dbms" name="dbms" value="mysql" placeholder="DBMS" /></td>
            </tr>
            <tr>
                <td>Utente database:</td>
                <td><input type="text" id="dbuser" name="dbuser" placeholder="Username database" /></td>
            </tr>
            <tr>
                <td>Password database:</td>
                <td><input type="password" id="dbpass" name="dbpass" placeholder="Password database" /></td>
            </tr>
            <tr>
                <td>Nome database:</td>
                <td><input type="text" id="dbname" name="dbname" placeholder="Nome database"/></td>
            </tr>
            <tr>
                <td>Hostname database:</td>
                <td><input type="text" id="dbhost" name="dbhost" placeholder="Hostname database"/></td>
            </tr>
            <caption>Informazioni E-Mail</caption>
            <tr>
                <td>Host E-Mail:</td>
                <td><input type="text" id="smtphost" name="smtphost" placeholder="Host E-Mail"/></td>
            </tr>
            <tr>
                <td>Porta:</td>
                <td><input type="text" id="smtpport" name="smtpport" placeholder="Porta"/></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" id="smtpuser" name="smtpuser" placeholder="Username E-Mail"/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" id="smtppass" name="smtppass" placeholder="Password E-Mail"/></td>
            </tr>
        </table>
        <input type="hidden" name="task" value="setup" />
        <input type="submit" />
    </form>
</div>








</body>

</html>
