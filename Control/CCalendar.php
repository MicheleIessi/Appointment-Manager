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
        if($tipoUtente == 'cliente'||$tipoUtente == 'professionista') {
            $VCal = new VCalendar();
            $FPro = new FProfessionista();
            $arrayProf = $FPro->caricaProfessionisti();
            $arrayLink = $this->getArrayPerLink($arrayProf);
            $VCal->setData('prof',$arrayLink);

            return $VCal->processaTemplate();
        }
        else {
            return true;
        }
    }

    public function getServiziProf($idp) {

        $FProf = new FProfessionista();
        $servProf = $FProf->ricavaServiziOfferti($idp);
        $VCal = new VCalendar();
        $servizi = array();
        foreach($servProf as $servizio) {
            $arraySer = array();
            $arraySer['nome'] = $servizio->getNomeServizio();
            $arraySer['descrizione'] = $servizio->getDescrizione();
            $arraySer['settore'] = $servizio->getSettore();
            $arraySer['durata'] = $servizio->getDurata();
            array_push($servizi,$arraySer);
        }
        $VCal->setData('servizi',$servizi);
        return $VCal->getColonnaServizi();
    }

    public function getColonnaProfessionista() {
        $VCal = new VCalendar();
        return $VCal->fetch('colonnaCancellazione.tpl');
    }


    private function getArrayPerLink($arrayProf) {

        $arrayLink = array();
        foreach($arrayProf as $professionista) {
            $profLink = array();
            $profLink['id'] = $professionista->getID();
            $profLink['nome'] = $professionista->getNome();
            $profLink['cognome'] = $professionista->getCognome();
            array_push($arrayLink,$profLink);
        }
        return $arrayLink;
    }

    public function setIDP($idp) {
        self::$idp = $idp;
    }

    public function getIDP() {
        return self::$idp;
    }

}