<?php
/**
 * FUtente si occupa di gestire gli scambi di informazioni con la tabella utente.
 *
 * @package  Foundation
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class FUtente extends Fdb   {

    private $login_key='email,password';
    private $login_bind=':email,:password';
    private $confirm_key='codiceconferma';
    private $confirm_bind=':codiceconferma';
    private $mail_bind=':email';
    private $mail_key='email';

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'utente';
        $this->primary_key = 'numID';
        $this->attributi = 'numID,nome,cognome,dataNascita,codiceFiscale,sesso,email,password,codiceconferma';
        $this->return_class = 'EUtente';
        $this->bind = ':numID,:nome,:cognome,:dataNascita,:codiceFiscale,:sesso,:email,:password,:codiceconferma';
        $this->bind_key = ':numID';
        $this->old_keys;

    }

    /** Il metodo inserisciUtente cerca di inserire un oggetto della classe EUtente nel Database. Se esiste già un
     * utente con lo stesso codice fiscale nel database l'aggiunta non viene effettuata.
     * @param EUtente $u L'oggetto EUtente che si vuole aggiungere al database.
     * @return bool true se c'è stata una aggiunta
     */
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
                    return true;
            }
            else
                echo "Utente già presente nel database.<br>";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /** La funzione cancellaUtente cancella un utente dal database.
     * @param EUtente $u L'utente che si vuole cancellare
     * @return bool true se la cancellazione è avvenuta, false altrimenti.
     */
    public function cancellaUtente(EUtente $u) {
        $this->setParametri();
        try {
            $id = $u->getID();
            $valori=array(':numID'=>$id);
            if(parent::cancella($valori) != 0) {
                return true;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /** La funzione aggiornaUtente cerca di modificare una ennupla della tabella utente prendendo come input un oggetto
     * di tipo EUtente. L'oggetto di tipo EUtente passato come parametro deve avere un id valido, cioè deve essere stato
     * creato con l'id di un utente conosciuto O essere stato creato tramite la funzione caricaUtenteDaDb avente come
     * parametro l'id dell'utente.
     * @param EUtente $u L'utente che si vuole modificare
     * @return bool true se c'è stata una modifica
     * @throws Exception Se non sono state apportate modifiche (ossia se l'oggetto EUtente passato come parametro non ha differenze rispetto al suo corrispettivo sul db)
     */
    public function aggiornaUtente(EUtente $u) {
        $this->setParametri();
        try {
            $valori = parent::cambiaChiaviArray($u->getArrayAttributi());
            $this->old_keys = $u->getID();
            if(parent::aggiorna($valori) == 0) {
                throw new Exception("Modifica utente fallita: non hai apportato modifiche.");
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    /** Il metodo caricaUtenteDaConferma è un analogo di caricaUtenteDaDb e di caricaUtenteDaMail. Questo metodo carica
     * un oggetto EUtente a partire da un codice di conferma.
     * @param $code string Il codice di conferma da cercare
     * @return bool | EUtente false se non è presente, altrimenti un oggetto EUtente corrispondente alla ennupla sul db.
     */
    public function caricaUtenteDaConferma($code){
        $this->setParametri();
        $binding=$this->confirm_bind;
        $arr=array();
        $arr[$binding]=$code;
        try {
            $arrayUte = parent::caricaConChiave($arr, $this->confirm_key);
            if($arrayUte == false) {
                return false;
            }
            else {
                $arrayUte = array_values($arrayUte[0]);
                $ute = new $this->return_class($arrayUte[1], $arrayUte[2], $arrayUte[3], $arrayUte[4],
                    $arrayUte[5], $arrayUte[6], $arrayUte[7],$arrayUte[8],$arrayUte[0]);
                return $ute;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /** Il metodo caricaUtenteDaMail è un analogo di caricaUtenteDaDb e di caricaUtenteDaMail. Questo metodo carica
     * un oggetto EUtente a partire da un indirizzo email.
     * @param $mail string La mail da cercare
     * @return bool | EUtente false se non è presente, altrimenti un oggetto EUtente corrispondente alla ennupla sul db.
     */
    public function caricaUtenteDaMail($mail){
        $this->setParametri();
        $binding=$this->mail_bind;
        $arr=array();
        $arr[$binding]=$mail;
        try {
            $arrayUte = parent::caricaConChiave($arr, $this->mail_key);
            if($arrayUte == false) {
                return false;
            }
            else {
                $arrayUte = array_values($arrayUte[0]);
                $ute = new $this->return_class($arrayUte[1], $arrayUte[2], $arrayUte[3], $arrayUte[4],
                    $arrayUte[5], $arrayUte[6], $arrayUte[7],$arrayUte[8],$arrayUte[0]);
                return $ute;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }

    /** Il metodo caricaUtenteDaDb crea un oggetto EUtente dopo aver effettuato una query di tipo select
     * nella tabella, prendendo come parametro l'id dell'utente da cercare
     * @param $key int L'id dell'utente
     * @return EUtente L'utente con id scelto
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
                                       $arrayUte[6],$arrayUte[7],$arrayUte[8],$arrayUte[0]);
        return $ute;
    }

    /** Il metodo caricaUtenteDaLogin crea un oggetto EUtente dopo aver effettuato una query di tipo sleect nella
     * tabella prendendo come parametri l'indirizzo email e la password dell'utente. Serve per effettuare il login.
     * @param $email string L'email dell'utente.
     * @param $password string La password dell'utente.
     * @return EUtente | bool L'utente con mail e password inserite, o false se non ce ne sono con quelle credenziali.
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
                return false;
            }
            else {
                $arrayUte = array_values($arrayUte[0]);
                $ute = new $this->return_class($arrayUte[1], $arrayUte[2], $arrayUte[3], $arrayUte[4],
                    $arrayUte[5], $arrayUte[6], $arrayUte[7], $arrayUte[8], $arrayUte[0]);
                //echo "Utente {$ute->getNome()} {$ute->getCognome()} ha effettuato correttamente il login.<br>";
                return $ute;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /** Il metodo controllaEsistenza verifica se esiste già una ennupla nella tabella utente con la chiave passata
     * come parametro uguale al valore passato come parametro. È un metodo di supporto usato per operazioni quali la
     * registrazione o il cambiamento dei dati utente, per verificare che non ci siano più utenti con le stesse
     * credenziali sensibili.
     * @param $chiave string La chiave passata come parametro. Può essere 'email','codiceFiscale' o 'codiceconferma'.
     * @param $valore string Il valore da verificare
     * @return bool false se non è presente, true altrimenti.
     */
    public function controllaEsistenza($chiave, $valore) {
        $this->setParametri();
        $valori = array();
        $esito = false;
        if($chiave == 'email') {
            $mail = strtolower($valore);
            $valori[':email'] = $mail;
        }
        else if($chiave == 'codiceFiscale') {
            $valore = strtoupper($valore);
            $valori[':codiceFiscale'] = $valore;
        }
        elseif($chiave=='codiceconferma'){
            $valore=  strtoupper($valore);
            $valori[':codiceconferma']=$valore;
        }
        try {
            if(parent::caricaConChiave($valori, $chiave) == false) // non c'è
                $esito = false;
            else
                $esito = true;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $esito;
    }

    private function setParametri() {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }


}