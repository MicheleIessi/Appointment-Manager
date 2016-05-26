<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of USession
 *
 * @author Michele
 */
class USession {
    
    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    function impostaValore($chiave,$valore) {
        $_SESSION[$chiave] = $valore;
    }
    function cancellaValore($chiave) {
        unset($_SESSION[$chiave]);
    }
    function getValore($chiave) {
        if(isset($_SESSION[$chiave])) {
            return $_SESSION[$chiave];
        }
        else {
            return false;
        }
    }
    function fineSessione() {
        unset($_SESSION);
        session_destroy();
    }
}