<link type="text/css" rel="stylesheet" href="css/modificaUtente.css" />

<script type="text/javascript" src='JS/validation/dateITA.js'></script>
<script type="text/javascript" src='JS/modificaUtente.js'></script>
<script type="text/javascript" src='JS/jquery-ui/jquery-ui.min.js'></script>
<script type="text/javascript" src='JS/jquery-ui/datepicker-it.js'></script>

<div id="contenitoreForm">

    <h1>Modifica informazioni</h1>

    <form name="modificaUtente" id="modificaUtente" method="post" action="modificaUtente.php">

        <table>

            <tr>
                <td>Nome</td>
                <td> <input type="text" name="nome" id="nome" ></td>
            </tr>

            <tr>
                <td>Cognome</td>
                <td> <input type="text" name="cognome" id="cognome" ></td>
            </tr>

            <tr>
                <td>Data di nascita</td>
                <td> <input type=text name="dataNascita" id="datepicker" ></td>
            </tr>
            
            <tr>
                <td>Codice fiscale</td>
                <td> <input type=text name="codiceFiscale" id="codiceFiscale" ></td>
            </tr>

            <tr>
                <td>Sesso</td>
                <td> M<input type="radio" name="sesso" id="maschio" value="M" checked> F<input type="radio" name="sesso" id="femmina" value="F"></td>
            </tr>

            <tr>
                <td>Email</td>
                <td> <input type="text" name="email" id="email" ></td>
            </tr>

            <tr>
                <td>Password</td>
                <td> <input type="password" name="password1" id="password1" ></td>
            </tr>

            <tr>
                <td>Conferma Password</td>
                <td> <input type="password" name="password2" id="password2" ></td>
            </tr>

            <tr>
                <td><input id="submit" type="submit" value=" INVIA "><td/>
            </tr>

        </table>
            
    </form>
    
    {if $messaggio}
        <label>{$messaggio}</label>
    {/if}

</div>