<link type="text/css" rel="stylesheet" href="View/css/paginaCliente.css" />

<div title="contenitoreUtente"id='contenitoreUtente'>
    
            

            <h2>Pagina Cliente - ID Utente: {$numID} </h2>

            <div title="immagine" id="immagine">
                Carica Immagine
            </div>

            <div title="datiUtente" id="datiUtente">
                
                <ul>
                    <li>Nome: {$nome} </li>
                    <li>Cognome: {$cognome} </li>
                    <li>Data di nascita: {$dataNascita} </li>
                    <li>Sesso: {$sesso} </li>
                    <li>Codice fiscale: {$codiceFiscale} </li>
                    <li>Email: {$email} </li>
                    <br><br>Altre informazioni...
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
                    
                    <a href=?controller=modificaCliente id="modifica"><button>Modifica informazioni</button></a>
                    
                </table>
            

        </div>


