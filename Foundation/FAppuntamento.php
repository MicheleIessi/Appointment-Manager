<?php

class FAppuntamento extends Fdb  {

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'appuntamento';
        $this->primary_key = 'IDApp';
        $this->attributi = 'IDApp,IDP,IDC,data,orarioInizio,visita';
        $this->return_class = 'EAppuntamento';
        $this->bind = ':IDApp,:IDP,:IDC,:data,:orarioInizio,:visita';
        $this->bind_key = ':IDApp';
        $this->old_keys;
    }

    public function inserisciAppuntamento(EAppuntamento $app) {
        $this->setParametriInserimento();
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
        $valoriDaCercare = array_slice($valori,0,3,true);
        $chiaveDaCercare = 'IDP,IDC,data';
        try {
            if(parent::caricaConChiave($valoriDaCercare,$chiaveDaCercare) != false) {
                throw new PDOException("Appuntamento già presente nel database."); //sarebbe meglio mettere un return che simboleggia il risultato
            }
            else {
                if (parent::inserisci($valori) == 0) {
                    throw new PDOException("Il cliente con id ".$valori[':IDC']." non esiste.<br>");
                } else
                    echo("Appuntamento aggiunto correttamente al database." . "<br>");
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cancellaAppuntamento($key) {
        $this->setParametri();
        $valori[':IDApp']=$key;
        try {
            if (parent::cancella($valori) == 0) {
                throw new PDOException("Appuntamento con ID $key non presente nel database.");
            } else
                echo("Appuntamento con ID $key rimosso con successo.");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function aggiornaAppuntamento(EAppuntamento $app) {
        if($app->getIDAppuntamento() !== 0) {
            $this->setParametri();
            $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
            $valori[':visita'] = $valori[':visita']->getNomeServizio();
            var_dump($valori);
            echo "<br>";
            try {
                if (parent::aggiorna($valori) == 0) {
                    throw new PDOException("Impossibile modificare l'appuntamento.<br>");
                } else
                    echo "Appuntamento con ID Professionista: '" . $valori[':IDP'] . "', ID Cliente: '" . $valori[':IDC'] . "' in data " . $valori[':data'] . " modificato correttamente.";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        else
            echo "Appuntamento non presente nel database o non caricato correttamente.<br>";
    }

    /**
     * @param $key
     * @return EAppuntamento
     */
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
        $fs=new FServizio();
        $servizio=$fs->caricaServizioDaDb($arrayApp['visita']);
        $this->old_keys = implode(',',$arrayApp);
        $app = new $this->return_class($arrayApp['IDP'],$arrayApp['IDC'],$arrayApp['data'],
                                       $arrayApp['orarioInizio'],$servizio,$arrayApp['IDApp']);
        return $app;
    }

    public function caricaAppuntamentiProfessionista($idp) {
        $this->setParametri();
        $valori=array();
        $valori[':IDP']=$idp;
        $res =  parent::caricaConChiave($valori,'IDP');
        $risultato = array();
        foreach($res as $appuntamento) {
            $fs=new FServizio();
            $servizio=$fs->caricaServizioDaDb($appuntamento['visita']);
            $app = new $this->return_class($appuntamento['IDP'],$appuntamento['IDC'],$appuntamento['data'],
                                           $appuntamento['orarioInizio'],$servizio,$appuntamento['IDApp']);
            array_push($risultato,$app);
        }
        return $risultato;
    }

    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }

    private function setParametriInserimento() {
        $alt_attr="IDP,IDC,data,orarioInizio,visita";
        $alt_bind=":IDP,:IDC,:data,:orarioInizio,:visita";
        $alt_keys=":IDP,:IDC,:data";
        parent::setParam($this->table,$alt_attr,$alt_bind,$alt_keys,$this->old_keys);
    }

}
