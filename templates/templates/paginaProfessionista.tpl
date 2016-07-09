<head>
    <link type="text/css" rel="stylesheet" href="View/css/paginaProfessionista.css"/>
</head>

<div title="contenitoreUtente" id="contenitoreUtente">
        
    <h2 id="titolo">Pagina Professionista - ID Utente {$numID}</h2>

    <div title="immagine" id="immagine">
        {if $modifica}
            <a rel="leanModal" href="#caricamentoImmagine" id="bottoneImmagine"><img src="img/modifica.gif" id="immModifica" /></a>
        {/if}
        {if $immagine}
            <image id="immagineProfilo" src="{$immagine}" />
        {/if}
    </div>

    <div title="datiUtente" id="datiUtente">

        <ul>
            <li>Nome: {$nome} </li><br>
            <li>Cognome: {$cognome} </li><br>
            <li>Data di nascita: {$dataNascita} </li><br>
            <li>Sesso: {$sesso} </li><br>
            <li>Codice fiscale: {$codiceFiscale} </li><br>
            <li>Email: {$email} </li><br>
            <li>Settore: {$settore} </li>
        </ul> 
        
    </div>
        
    {if $modifica}
        <a href=?controller=modificaUtente><button class="bottoneProf">Modifica informazioni</button></a>
    {/if}

    <h3>Orario di lavoro</h3>
    
    <div title="orariLavoro" class="tabProfessionisti">
        <table id="orariLavoro">
            
            <tr>
                <td>Lunedì</td>
                <td> {$orariLavorativi['lun']} </td>
            </tr>

            <tr>
                <td>Martedì</td>
                <td> {$orariLavorativi['mar']} </td>
            </tr>

            <tr>
                <td>Mercoledì</td>
                <td> {$orariLavorativi['mer']} </td>
            </tr>

            <tr>
                <td>Giovedì</td>
                <td> {$orariLavorativi['gio']} </td>
            </tr>

            <tr>
                <td>Venerdì</td>
                <td> {$orariLavorativi['ven']} </td>
            </tr>

            <tr>
                <td>Sabato</td>
                <td> {$orariLavorativi['sab']} </td>
            </tr>

            <tr>
                <td>Domenica</td>
                <td> {$orariLavorativi['dom']} </td>
            </tr>

        </table>
    </div>
     
    <h3>Servizi offerti da {$nomeUtente}</h3>
    
    <div title="serviziOfferti" class="tabProfessionisti">
        <table id="serviziOfferti">
                        
            <tr id="chiavi">
                <td>Nome servizio</td>
                <td>Settore</td>
                <td>Durata</td>
                <td>Descrizione</td>
            </tr>
            
                {foreach $serviziOfferti as $servizio}
                    <tr>
                            <td id="servizio">{$servizio['nomeServizio']}</td>
                            <td id="servizio">{$servizio['settore']}</td>
                            <td id="servizio">{$servizio['durata']}</td>
                            <td id="servizio">{$servizio['descrizione']}</td>
                        </tr>
                {/foreach}
                
        </table>
    </div>
    
    {if $proprietario OR $tipo=="cliente"}
        <a href="?controller=calendario&idp={$numID}"><button class="bottoneProf">

            {if $proprietario}
                Apri la tua agenda
                {else}
                Prenota un appuntamento! Clicca per aprire l'agenda di {$nomeUtente}
            {/if}

        </button></a>
    {/if}
    
    {if $modifica}            
    <div title="caricamentoImmagine" id="caricamentoImmagine">
        
        <h2>Carica immagine</h2>
        
        <form enctype="multipart/form-data" action="caricaImmagine.php" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
            <input type="hidden" name="utenteCorrente" value="{$numID}" />
            <table>
                <tr>
                    <td> <input id="fileLabel" name="immagineUtente" type="file"> </td>
                </tr>
                <tr>
                    <td> <input type="submit" value="Carica"> </td>
                </tr>            
            </table>
        </form>
                
    </div>
    {/if}
    
</div>
