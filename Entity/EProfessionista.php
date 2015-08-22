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
            controllaEsistenza($so, "servizio");
            array_push($this->serviziOfferti, $servizio);
        }
    }
    
    public function setSettore($set) {
        $this->settore = [];
        foreach ($set as $value) {
            controllaEsistenza($set, "settore");
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
    
    public function aggiungiServizio($so) {
        controllaEsistenza($so, "servizio");
        array_push($this->serviziOfferti, $so);
    }
    
    public function aggiungiSettore($set) {
        if(count($this->settore) >= 3) {
            throw new Exception("Limite settori raggiunto", 2);
        }
        controllaEsistenza($set, "settore");
        array_push($this->settore, $set);
    }
    
    public function rimuoviServizio($so) {
        controllaEsistenza($so, "servizio");
        if(($key = array_search($so, $this->serviziOfferti)) !== false) {
            unset($this->serviziOfferti[$key]);
            $this->serviziOfferti = array_values($this->serviziOfferti);
        }
        else {
            throw new Exception ("Servizio non presente", 2);
        }
    }
    
    private function controllaEsistenza($servizio, $tipo) {
        //controlla l'esistenza di un servizio o di un settore e ritorna true o false
        if($tipo === "servizio") {      // cerca tra i servizi
            ;
        }
        else if ($tipo === "settore") { // cerca tra i settori
            ;
        } 
        else {
            throw new Exception("Tipo non valido", 2);
        }
    }
}
