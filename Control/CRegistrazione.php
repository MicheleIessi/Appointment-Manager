<?php
/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 25/05/2016
 * Time: 14:09
 */

require_once('includes/autoload.inc.php');

class CRegistrazione {
    /**
     * @var string $username
     */
    private $username;
    /**
     * @var string $password
     */
    private $password;

    /**
     * Controlla se l'utente è registrato e autenticato
     * @return bool
     */
    public function getUtenteReg() {
        $autenticato = false;
        $session = new USession();
        if($session->getValore('email')!=false) {//l'utente è autenticato
            $autenticato=true;
        }
        return $autenticato;
    }
}