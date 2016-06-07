<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link type="text/css" rel='stylesheet' href='JS/fullcalendar-2.6.1/fullcalendar.css' />
        <link type="text/css" rel="stylesheet" href='View/css/prova.css' />
        <link type="text/css" rel="stylesheet" href="View/css/login.css" />
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery-ui.custom.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/fullcalendar.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lang-all.js'></script>
        <script type="text/javascript" src='JS/JCalendar.js'></script>
        <script type="text/javascript" src="JS/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="JS/JLogin.js"></script>
        <title>{$title}</title>
    </head>
    <body>
    <!-- BANNER -->
    {$banner}
    <!-- MAIN BUTTONS -->
    <div class="wrapper">
        <div class ="mainButtons">
            {foreach $mainButtons as $button}
                {if $button['testo'] eq 'Login' or $button['testo'] eq 'Registrati' }
                    {$nolog = true}
                    <a class='buttonElem' rel="leanModal" href="{$button['link']}" id="modaltrigger">{$button['testo']}</a>
                {else}
                <a class='buttonElem' href="{$button['link']}">{$button['testo']}</a>
                {/if}
            {/foreach}
        </div>
    </div>
    {if $nolog} <!-- L'utente corrente non è loggato o non è registrato. Sono quindi presenti i div relativi a login e registrazione con leanmodal-->
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
    {/if}
    <div class ="main">
        <!-- MAIN CONTENT -->
        <div id='content'>
            {$main_content}
        </div>
        <!-- SIDE CONTENT -->
        <div class="side_content">
            {$right_content}
        </div>
        </div>
    </body>
</html>