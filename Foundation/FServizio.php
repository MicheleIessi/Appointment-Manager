<?php

class FServizio extends Fdb     {
    
    public function __construct() {
        parent::__construct();
        $this->table = "servizi";
        $this->primary_key = 'nomeServizio';
        $this->attributi = 'nomeServizio,descrizione,settore,durata';
        $this->return_class = 'EServizio';
        $this->bind = ':nomeServizio,:descrizione,:settore,:durata';
        $this->bind_key = ':nomeServizio';
    }

    public function inserisciServizio(EServizio $es) {
        $valori = $this->cambiaChiaviArray($es->getArrayAttributi());
        $this->setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        try {
            if ($this->inserisci($valori) == 0) {
                throw new PDOException("Servizio chiamato '" . $valori[':nomeServizio'] . "' già presente nel database."."<br>");
            }
            else
                echo ("Servizio chiamato '".$valori[':nomeServizio']."' aggiunto correttamente al database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function cancellaServizio(Eservizio $es) {
        $valori = $this->cambiaChiaviArray($es->getArrayAttributi());
        $this->setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        try {
            if($this->cancella(array_slice($valori,0,1,true)) == 0) {
                throw new PDOException("Servizio chiamato '" . $valori[':nomeServizio'] . "' non presente nel database."."<br>");
            }
            else
                echo ("Servizio chiamato '". $valori[':nomeServizio'] . "' rimosso correttamente dal database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function aggiornaServizio(Eservizio $es) {
        $this->setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        $valori = $this->cambiaChiaviArray($es->getArrayAttributi());
        try {
            if($this->aggiorna($valori) == 0) {
                throw new PDOException("Impossibile modificare il servizio.");
            }
            } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function caricaServizio($key) {
        $this->setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        $valori=array();
        $valori[":$this->primary_key"] = $key;
        $arraySer = $this->carica($valori);
        $arraySer = array_values($arraySer);
        $es = new $this->return_class($arraySer[0],$arraySer[1],$arraySer[2],$arraySer[3]);
        return $es;
    }
}