<?php

class FServizio extends Fdb {

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = "servizio";
        $this->primary_key = 'nomeServizio';
        $this->attributi = 'nomeServizio,descrizione,settore,durata';
        $this->return_class = 'EServizio';
        $this->bind = ':nomeServizio,:descrizione,:settore,:durata';
        $this->bind_key = ':nomeServizio';
        $this->old_keys;
    }

    public function inserisciServizio(EServizio $es) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
        $valori = parent::cambiaChiaviArray($es->getArrayAttributi());
        try {
            if (parent::inserisci($valori) == 0) {
                throw new PDOException("Servizio chiamato '" . $valori[':nomeServizio'] . "' già presente nel database."."<br>");
            }
            else
                echo ("Servizio chiamato '".$valori[':nomeServizio']."' aggiunto correttamente al database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cancellaServizio(Eservizio $es) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
        $valori = parent::cambiaChiaviArray($es->getArrayAttributi());
        try {
            if(parent::cancella(array_slice($valori,0,1,true)) == 0) {
                throw new PDOException("Servizio chiamato '" . $valori[':nomeServizio'] . "' non presente nel database."."<br>");
            }
            else
                echo ("Servizio chiamato '". $valori[':nomeServizio'] . "' rimosso correttamente dal database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function aggiornaServizio(Eservizio $es) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
        $valori = parent::cambiaChiaviArray($es->getArrayAttributi());
        $valori[':durata']=intval($valori[':durata']);
        try {
            if(parent::aggiorna($valori) == 0) {
                throw new PDOException("Impossibile modificare il servizio.<br>");
            }
            else
                echo "Servizio modificato correttamente.<br>";
            } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function caricaServizioDaDb($key) {
        $es = false;
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
        $valori=array();
        $valori["$this->bind_key"] = $key;
        try {
            $arraySer = parent::carica($valori);
            if(!is_array($arraySer)) throw new PDOException("Nessun servizio chiamato $key.<br>");
            $this->old_keys = implode(',', $arraySer);
            $es = new $this->return_class($arraySer['nomeServizio'], $arraySer['descrizione'], $arraySer['settore'], $arraySer['durata']);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $es;
    }

}