<link type="text/css" rel="stylesheet" href="View/css/paginaCliente.css" />

<div title="contenitoreUtente"id='contenitoreUtente'>
            
            

            <h2>Pagina Cliente - ID Utente: {$numID} </h2>

            <div id="immagine">
                {if $modifica}
                <a class='buttonElem' rel="leanModal" href="#caricamentoImmagine" id="bottoneImmagine"></a>
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
                    <li>Codice fiscale: {$codiceFiscale} </li><br>
                    <li>Sesso: {$sesso} </li><br>
                    <li>Email: {$email} </li><br>
                    <br>
                </ul>
                
            </div>            
            
                <h3>Cronologia Appuntamenti </h3>
                <table id="pastAppTable">
                    <tr id="chiavi">
                        <td>Data</td> 
                        <td>Orario</td> 
                        <td>Servizio</td> 
                        <td>Professionista</td>
                    </tr>
                    
                    {foreach $cronologia as $app} 
                        <tr>
                            <td>{$app['data']}</td>
                            <td>{$app['orario']}</td>
                            <td>{$app['nomeServ']}</td>
                            <td><a href=?controller=paginaProfessionista&id={$app['idProf']} >{$app['nomeProf']} </a></td>
                        </tr>
                    {/foreach}
                    
                    {if $modifica}
                    <a href=?controller=modificaUtente><button id="modifica">Modifica informazioni</button></a>
                    {/if}
                </table>
                
     <!-- ----------------------------------------------------------------------------------------------------- -->           
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


