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

        /*
         * prima di inserire, devo prendere tutti gli appuntamenti di quel giorno e vedere se ci sono degli accavallamenti.
         * due intervalli di tempo si accavallano se e solo se:
         * (data da mettere: data1. data già esistente: data2)
         * inizio1<=fine2 && fine1>=inizio2
         * se questa cosa è true allora gli eventi si accavallano e non posso inserire il nuovo appuntamento
         */
        $this->setParametriInserimento();
        $valori = parent::cambiaChiaviArray($app->getArrayAttributi());
        $valori[':visita'] = $valori[':visita']->getNomeServizio();
        $valoriDaCercare = array_slice($valori,1,3,true);
        $chiaveDaCercare = 'IDP,IDC,data';
        try {
            if(parent::caricaConChiave($valoriDaCercare,$chiaveDaCercare) != false) {
                return false; //sarebbe meglio mettere un return che simboleggia il risultato
            }
            else { // vuol dire che l'utente non ha già un appuntamento per il giorno selezionato
                //controllo se altri utenti non hanno una prenotazione nell'orario scelto
                $chiaveData = array();
                $chiaveData[':IDP'] = $app->getIDProfessionista();
                $chiaveData[':data'] = $app->getData();
                $valoreData = 'IDP,data';
                $appDelGiorno = parent::caricaConChiave($chiaveData, $valoreData);
                $oraInizio1 = new DateTime($app->getOrario());
                $durata = $app->getVisita()->getDurata();
                list($ore, $minuti, $secondi) = explode(':', $durata);
                $intervallo = new DateInterval("PT" . $ore . "H" . $minuti . "M" . $secondi . "S");
                $oraFine1 = $oraInizio1->add($intervallo);
                $esito = true;
                $FSer = new FServizio();
                foreach ($appDelGiorno as $appuntamento) {

                    $oraInizio2 = new DateTime($appuntamento['orarioInizio']);
                    $ser = $FSer->caricaServizioDaDb($appuntamento['visita']);
                    $durata = $ser->getDurata();
                    list($ore, $minuti, $secondi) = explode(':', $durata);
                    $intervallo = new DateInterval("PT" . $ore . "H" . $minuti . "M" . $secondi . "S");
                    $oraFine2 = $oraInizio1->add($intervallo);

                    if ($oraInizio1 < $oraFine2 && $oraFine1 > $oraInizio2) {
                        $esito = false;
                    }
                }
                if ($esito) {
                    if (parent::inserisci($valori) == 0) {
                        throw new PDOException("Il cliente con id " . $valori[':IDC'] . " non esiste.<br>");
                    } else
                        return true;
                }
                else
                    throw new PDOException("Impossibile inserire un appuntamento che si accavalla con un altro.");
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
            } else {
                return true;
            }
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

    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }

    private function setParametriInserimento() {
        $alt_attr="IDApp,IDP,IDC,data,orarioInizio,visita";
        $alt_bind=":IDApp,:IDP,:IDC,:data,:orarioInizio,:visita";
        $alt_keys=":IDP,:IDC,:data";
        parent::setParam($this->table,$alt_attr,$alt_bind,$alt_keys,$this->old_keys);
    }

//    public function getLastID() {
//        return parent::$last_id; // TODO: Change the autogenerated stub
//    }

}
