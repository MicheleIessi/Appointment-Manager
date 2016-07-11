<?php

/**
 * USession si occupa di gestire le sessioni.
 *
 * @package  Utility
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */

class USession {
    /**
     * USession constructor. Viene effettuata una session_start solo se la variabile $_SESSION non è già settata
     */
    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    /** Imposta un valore all'interno della variabile superglobale $_SESSION.
     * @param $chiave string La chiave
     * @param $valore string Il valore da impostare
     */
    function impostaValore($chiave,$valore) {
        $_SESSION[$chiave] = $valore;
    }

    /** Cancella un valore dalla variabile superglobale $_SESSION.
     * @param $chiave string la chiave per cui cancellare il valore.
     */
    function cancellaValore($chiave) {
        unset($_SESSION[$chiave]);
    }

    /** Restituisce un valore presente all'interno di $_SESSION.
     * @param $chiave string La chiave per cui cercare il valore.
     * @return bool | mixed Se c'è restituisce il valore, altrimenti restituisce false.
     */
    function getValore($chiave) {
        if(isset($_SESSION[$chiave])) {
            return $_SESSION[$chiave];
        }
        else {
            return false;
        }
    }

    /**
     * Chiude la sessione facendo l'unset di $_SESSION e chiamando session_destroy().
     */
    function fineSessione() {
        unset($_SESSION);
        session_destroy();
    }
}