<?php

class EServizio {
    
    // Attributi
    private $nomeServizio;
    private $descrizione;
    private $settore;
    private $durata=0;

    // Costruttore
    public function __construct($nom,$des, $set, $dur)   {
        $this->setNomeServizio($nom);
        $this->setDescrizione($des);
        $this->setSettore($set);
        $this->setDurata($dur);
    }
    
    // Metodi
    public function setNomeServizio($nom)    {
        $this->nomeServizio=$nom;
    }
    
    public function setDescrizione($des)    {
        $this->descrizione=$des;
    }
    
    public function setSettore($set)    {
        $this->settore=$set;
    }
    
    public function setDurata($dur)    {
        $this->durata=$dur;
    }
    
    public function getNomeServizio()   {
        return $this->nomeServizio;
    }
    
    public function getDescrizione()    {
        return $this->descrizione;
    }
    
    public function getSettore()    {
        return $this->settore;
    }
    
    public function getDurata()   {
        return $this->durata;
    }
    
    // Metodo di utilità per il lato Foundation

    public function getArrayAttributi() {
        return array($this->nomeServizio,$this->descrizione,$this->settore,$this->durata);
    }

}