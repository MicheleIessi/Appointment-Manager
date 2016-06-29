
<div class='userContainer'>
    
    <h1>{$nomeUtente}</h1>
    
    <div class="immagine">
        qui dentro ci andrà la foto dell'utente (se vogliamo implementare il caricamento della foto)
    </div>

    <div class="datiUtente">
        <ul>
            <li>ID Utente: {$numID} </li> <br />
            <li>Nome: {$nome} </li>
            <li>Cognome: {$cognome} </li>
            <li>Data di nascita: {$dataNascita} </li>
            <li>Sesso: {$sesso} </li>
            <li>Codice fiscale: {$codiceFiscale} </li>
            <li>Email:{$email} </li>
        </ul>
    </div>

    <div class="Calendario">
        <a href="?controller=calendario&idp={$numID}">Prenota un appuntamento! Clicca per aprire l'agenda di {$nomeUtente}</a>
    </div>
    
</div>


