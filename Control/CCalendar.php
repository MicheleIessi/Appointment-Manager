<?php

/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 26/05/2016
 * Time: 18:19
 */
class CCalendar {

    public static $idp = 0; //id del professionista che sarà caricato nel calendario visto dall'utente

    public function smista() {
        $sessione = new USession();
        $tipoUtente = $sessione->getValore('tipo'); //normale o professionista
        if($tipoUtente == 'cliente') {
            $VCal = new VCalendar();
            return $VCal->processaTemplate();
        }
        else {
            return true;
        }
    }

    public function setIDP($idp) {
        self::$idp = $idp;
    }

    public function getIDP() {
        return self::$idp;
    }

}