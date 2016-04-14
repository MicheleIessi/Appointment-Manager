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
        $this->old_keys;
    }

    public function inserisciAppuntamento(EAppuntamento $app) {
        $this->setParametri();
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
        $this->setParametri();
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
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
        $this->setParametri();
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
        try {
            if(parent::aggiorna($valori) == 0) {
                throw new PDOException("Impossibile modificare l'appuntamento.<br>");
            }
            else
                echo "Appuntamento con ID Professionista: '" . $valori[':IDP'] . "', ID Cliente: '" . $valori[':IDC'] . "' in data " . $valori[':data'] . " modificato correttamente.";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function caricaAppuntamentoDaDb($key) {
        $this->setParametri();
        $valori=explode(',',$key);
        $binding=explode(',',$this->bind_key);
        $i=0;
        $arr = array();
        foreach($valori as $str) {
            $arr["$binding[$i]"]=$str;
            $i++;
        }
        $arrayApp = parent::carica($arr);
        $arrayApp = array_values($arrayApp);
        $fs=new FServizio();
        $servizio=$fs->caricaServizioDaDb($arrayApp[4]);
        $this->old_keys = implode(',',$arrayApp);
        $app = new $this->return_class($arrayApp[0],$arrayApp[1],$arrayApp[2],$arrayApp[3],$servizio);
        echo "Appuntamento caricato correttamente <br>";
        return $app;
    }

    public function caricaAppuntamentiProfessionista($idp) {
        $this->setParametri();
        parent::caricaConChiave($idp,'IDP');
    }

    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }


}
