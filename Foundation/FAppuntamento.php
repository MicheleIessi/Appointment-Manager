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
        $valori = $this->cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
        $this->setParam($this->table,$this->attributi,$this->bind,$this->bind_key);
        try {
            if($this->inserisci($valori) == 0) {
                throw new PDOException("Appuntamento già presente nel database.");
            }
            else
                echo ("Appuntamento aggiunto correttamente al database."."<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }







}
