<link type="text/css" rel="stylesheet" href="View/css/paginaCliente.css" />

<div title="contenitoreUtente"id='contenitoreUtente'>
    
            

            <h2>Pagina Cliente - ID Utente: {$numID} </h2>

            <div title="immagine" id="immagine">
                Carica Immagine
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
            

        </div>


