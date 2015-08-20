<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EProfessionista
 *
 * @author Michele
 */
class EProfessionista extends EUtente {

    private $serviziOfferti = [];
    private $settore = [];
    private $orari;
        
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id, $so, $set, $or) {
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrari($or);
    }
    
    public function setServiziOfferti($so) {
        $this->serviziOfferti = [];
        foreach ($so as $servizio) {
            //mancano i controlli
            array_push($this->serviziOfferti, $servizio);
        }
    }
    
    public function setSettore($set) {
        $this->settore = [];
        foreach ($set as $value) {
            //mancano i controlli
            array_push($this->settore, $value);
        }
    }
    
    public function setOrari($or) {
        $pattern = "#^(2[0-3]|[01][0-9]):([0-5][0-9])?#";
        if(preg_match($pattern, $or) != 1) {
            throw new Exception("Orario non valido", 1);
        }
        $this->orari = $or;
    }
}