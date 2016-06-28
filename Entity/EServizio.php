<?php

class EServizio {
    
    // Attributi
    private $nomeServizio;
    private $descrizione;
    private $settore;
    private $durata;

    // Costruttore
    public function __construct($nom,$des, $set, $dur)   {
        $this->setNomeServizio($nom);
        $this->setDescrizione($des);
        $this->setSettore($set);
        $this->setDurata($dur);
    }
    
    // Metodi
    public function setNomeServizio($nom) { $this->nomeServizio=$nom; }
    public function setDescrizione($des) { $this->descrizione=$des; }
    public function setSettore($set) { $this->settore=$set; }

    public function setDurata($dur) {
        $pattern = "#^([2][0-3]|[01][0-9]|[0-9]):([0-5][0-9]):([0-5][0-9])$#";
        if(preg_match($pattern, $dur) === 1)
            $this->durata = $dur;
        else
            echo "Durata del servizio non valida.<br>";
    }

    public function getNomeServizio() { return $this->nomeServizio; }
    public function getDescrizione() { return $this->descrizione; }
    public function getSettore() { return $this->settore; }
    public function getDurata() { return $this->durata; }
    // Metodo di utilità per il lato Foundation

    public function getArrayAttributi() {
        return array($this->nomeServizio,$this->descrizione,$this->settore,$this->durata);
    }

}