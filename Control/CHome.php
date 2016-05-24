<?php
/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 24/05/2016
 * Time: 16:51
 */

/**
 * 1. controllare se l'utente ha già effettuato il login (sessioni).
 * 2. se ha già effettuato il login, mandare la home con la possibilità di scegliere le opzioni utente (prenotazione, profilo...)
 * 3. altrimenti far vedere una pagina di presentazione con i pulsanti login/registrazione e senza le opzioni utente
 */

if(is_null($_SESSION)) {
    //mostra home per utente non loggato
}
else {
    //mostra home con utente loggato
}