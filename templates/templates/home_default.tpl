<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link type="text/css" rel="stylesheet" href='View/css/prova.css' />
        <link type="text/css" rel="stylesheet" href="View/css/login.css" />
        <link type="text/css" rel="stylesheet" href="View/css/jquery-ui.css" />
        
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/jquery.min.js'></script>
        <script type="text/javascript" src="JS/validation/jquery.validate.js"></script>
        <script type="text/javascript" src='JS/jquery-ui/jquery-ui.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lib/moment.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/fullcalendar.min.js'></script>
        <script type="text/javascript" src='JS/fullcalendar-2.6.1/lang-all.js'></script>
        <script type="text/javascript" src='JS/JCalendar.js'></script>
        <script type="text/javascript" src="JS/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="JS/JLogin.js"></script>
        
        <title>{$title}</title>
    </head>
    <body>
    <!-- BANNER -->
    <!-- MAIN BUTTONS -->
    {$nolog = false}
    
    <div id="wrapper">
        <div id ="mainButtons">
            {$banner}
            {foreach $mainButtons as $button}
                {if $button['testo'] eq 'Login' or $button['testo'] eq 'Registrati' }
                    {$nolog = true}
                    <a class='buttonElem' rel="leanModal" href="{$button['link']}" id="modaltrigger">{$button['testo']}</a>
                {else}
                    {if $button['testo'] eq 'Logout'}
                        <a class='buttonElem' id="bottoneLogout" href="{$button['link']}">{$button['testo']}</a>
                    {else}
                        <a class='buttonElem' href="{$button['link']}">{$button['testo']}</a>
                    {/if}
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
                <form id='loginForm' method='post' action="index.php?controller=login">
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
                        <button type="submit" id="bottoneLogin">Login »</button>
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
                <form id='RegisterForm' method="post" action="index.php?controller=reg">
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
    {/if}
    <div class ="main">
        <!-- MAIN CONTENT -->
        {$main_content}
        
        <!-- SIDE CONTENT -->
        {if $right_content}
            <div id="side_content">
                {$right_content}
            </div>
        {/if}
        </div>
    </body>
</html>
