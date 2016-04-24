<?php

class FUtente extends Fdb   {

    private $login_key='email,password';
    private $login_bind=':email,:password';

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'utenti';
        $this->primary_key = 'numID';
        $this->attributi = 'numID,nome,cognome,dataNascita,codiceFiscale,sesso,email,password';
        $this->return_class = 'EUtente';
        $this->bind = ':numID,:nome,:cognome,:dataNascita,:codiceFiscale,:sesso,:email,:password';
        $this->bind_key = ':numID';
        $this->old_keys;

    }

    public function inserisciUtente(EUtente $u) {
        $this->setParametri();
        $valori = parent::cambiaChiaviArray($u->getArrayAttributi());
        $codFis = $u->getCodiceFiscale();
        $cod[':codiceFiscale'] = $codFis;
        try {
            if(parent::caricaConChiave($cod,'codiceFiscale') == false) {
                if (parent::inserisci($valori) == 0) {
                    throw new PDOException("Impossibile inserire l'utente.<br>");
                } else
                    echo "Utente aggiunto correttamente al database.<br>";
            }
            else
                echo "Utente già presente nel database.<br>";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cancellaUtente(EUtente $u) {
        $this->setParametri();
        $codFis = $u->getCodiceFiscale();
        $cod[':codiceFiscale'] = $codFis;
        try {
            $risultato = parent::caricaConChiave($cod,'codiceFiscale');
            if($risultato != false) {
                $id = $risultato['numID'];
                $valori=array(':numID'=>$id);
                parent::cancella($valori);
                echo "Utente cancellato con successo.<br>";
            }
            else
                throw new PDOException("Utente non presente nel database: impossibile cancellarlo.<br>");
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function aggiornaUtente(EUtente $u) {
        $this->setParametri();
        try {
            $codFis=$u->getCodiceFiscale();
            $cod[':codiceFiscale'] = $codFis;
            $risultato = parent::caricaConChiave($cod,'codiceFiscale');
            $id = $risultato['numID'];
            $u->setID($id);
            $valori = parent::cambiaChiaviArray($u->getArrayAttributi());
            $this->old_keys=$id;
            if(parent::aggiorna($valori) == 0) {
                throw new PDOException("Impossibile modificare l'utente.<br>");
            }
            else
                echo "Utente {$u->getNome()} {$valori[':cognome']} aggiunto correttamente al database.<br>";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $key
     * @return EUtente
     */
    public function caricaUtenteDaDb($key) {
        $this->setParametri();
        $valori=explode(',',$key);
        $binding=explode(',',$this->bind_key);
        $i=0;
        $arr = array();
        foreach($valori as $str) {
            $arr["$binding[$i]"]=$str;
            $i++;
        }
        $arrayUte = parent::carica($arr);
        $arrayUte = array_values($arrayUte);
        $ute = new $this->return_class($arrayUte[1],$arrayUte[2],$arrayUte[3],$arrayUte[4],$arrayUte[5],
                                       $arrayUte[6],$arrayUte[7],$arrayUte[0]);
        echo "Utente {$ute->getNome()} {$ute->getCognome()} caricato correttamente.<br>";
        return $ute;
    }

    /**
     * @param $email
     * @param $password
     * @return EUtente
     */
    public function caricaUtenteDaLogin($email,$password) {
        $this->setParametri();
        $valori=array($email,$password);
        $binding=explode(',',$this->login_bind);
        $i=0;
        $arr=array();
        foreach($valori as $str) {
            $arr["$binding[$i]"]=$str;
            $i++;
        }
        try {
            $arrayUte = parent::caricaConChiave($arr, $this->login_key);
            if($arrayUte == false) {
                echo "Nessun risultato.<br>";
            }
            else {
                $arrayUte = array_values($arrayUte);
                $ute = new $this->return_class($arrayUte[1], $arrayUte[2], $arrayUte[3], $arrayUte[4],
                    $arrayUte[5], $arrayUte[6], $arrayUte[7], $arrayUte[0]);
                echo "Utente {$ute->getNome()} {$ute->getCognome()} ha effettuato correttamente il login.<br>";
                return $ute;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }


}