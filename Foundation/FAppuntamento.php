<?php

class FAppuntamento extends Fdb  {
    
    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'appuntamenti';
        $this->primary_key = 'IDP,IDC,data';
        $this->attributi = 'IDP,IDC,data,orario,visita';
        $this->return_class = 'EAppuntamento';
        $this->bind = ':IDP,:IDC,:data,:orario,:visita';
        $this->bind_key = ':IDP,:IDC,:data';
    }

    public function inserisciAppuntamento(EAppuntamento $app) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
        try {
            if(parent::inserisci($valori) == 0) {
                throw new PDOException("Appuntamento già presente nel database."); //sarebbe meglio mettere un return che simboleggia il risultato
            }
            else
                echo ("Appuntamento aggiunto correttamente al database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cancellaAppuntamento(EAppuntamento $app) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        try {
            if (parent::cancella(array_slice($valori, 0, 3, true)) == 0) {
                throw new PDOException("Appuntamento non presente nel database.");
            } else
                echo("Appuntamento con ID Professionista: '" . $valori[':IDP'] . "', ID Cliente: '" . $valori[':IDC'] . "' in data " . $valori[':data'] . " rimosso con successo.");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function aggiornaAppuntamento(EAppuntamento $app) {

    }

}
