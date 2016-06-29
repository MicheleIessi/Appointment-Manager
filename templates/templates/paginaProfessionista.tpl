<div class='userContainer'>

            <h1>{$nomeUtente}</h1>
            
            <p>
                {$settore}
            </p>
            
            <div class="immagine">
                qui dentro ci andrà la foto dell'utente (se vogliamo implementare il caricamento della foto)
            </div>

            <div class="datiUtente">
                <br />
                <ul>
                    <li>ID Utente: {$numID} </li> <br />
                    <li>Nome: {$nome} </li>
                    <li>Cognome: {$cognome} </li>
                    <li>Data di nascita: {$dataNascita} </li>
                    <li>Sesso: {$sesso} </li>
                    <li>Codice fiscale: {$codiceFiscale} </li>
                    <li>Email:{$email} </li>
                    <li>Settore:{$settore} </li>
                </ul> 
            </div>
            
            <div class="orariLavoro">
                <table>
                    
                    <tr>
                        <td>Lunedì</td>
                        <td> {$lun} </td>
                    </tr>
                    
                    <tr>
                        <td>Martedì</td>
                        <td> {$mar} </td>
                    </tr>
                    
                    <tr>
                        <td>Mercoledì</td>
                        <td> {$mer} </td>
                    </tr>
                    
                    <tr>
                        <td>Giovedì</td>
                        <td> {$gio} </td>
                    </tr>
                    
                    <tr>
                        <td>Venerdì</td>
                        <td> {$ven} </td>
                    </tr>
                    
                    <tr>
                        <td>Sabato</td>
                        <td> {$sab} </td>
                    </tr>
                    
                    <tr>
                        <td>Domenica</td>
                        <td> {$dom} </td>
                    </tr>
                    
                </table>
            </div>
            
            <div class="Calendario">
                <a href="?controller=calendario&idp={$numID}">Prenota un appuntamento! Clicca per aprire l'agenda di {$nomeUtente}</a>
            </div>

        </div>