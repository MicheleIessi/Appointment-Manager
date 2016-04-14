<?php

class FProfessionista extends Fdb {
    
    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table='professionisti';
        $this->primary_key='IDP';
        $this->attributi='IDP,settore,orari';
        $this->return_class='EProfessionista';
        $this->bind=':IDP,:settore,:orari';
        $this->bind_key=':IDP';
        $this->old_keys;
    }
    
    public function inserisciProfessionista(EProfessionista $pro) {
        $ute = $pro->getUtenteDaProfessionista();
        $fute = new FUtente();
        $ute2 = $fute->caricaUtenteDaLogin($ute->getEmail(),$ute->getPassword()); # cerco di trovare l'utente corrispondente al professionista che si vuole inserire
        if(is_null($ute2)) {
            # l'utente non è già nel db
            $fute->inserisciUtente($ute);
        }
        $id = $fute->caricaUtenteDaLogin($ute->getEmail(),$ute->getPassword())->getID();
        $pro->setID($id);
        $this->setParametri();
        $valori = parent::cambiaChiaviArray($pro->getArrayAttributi());
        try {
            if(parent::inserisci($valori) == 0) {
                throw new PDOException("Professionista già presente nel Database.<br>");
            }
            else {
                echo("Professionista aggiunto correttamente al database.<br>");
                /* I SERVIZI ANDREBBERO COLLEGATI E AGGIUNTI QUI DENTRO */
                $servizi = $pro->getServiziOfferti();
                $fser = new FServizio();
                /** @var EServizio $servizio */
                foreach($servizi as $servizio) {
                    $fser->inserisciServizio($servizio);    //inserisco il servizio o non faccio nulla se è già presente
                    $nomeSer = $servizio->getNomeServizio();
                    $arrQuery = array();
                    $arrQuery[":IDP"] = $id;
                    $arrQuery[":nomeServizio"] = $nomeSer;
                    parent::inserisciGenerica($arrQuery,"serviziOfferti");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }

}