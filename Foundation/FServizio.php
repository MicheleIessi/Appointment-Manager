<?php
/**
 * FServizio si occupa di gestire gli scambi di informazioni con la tabella servizio.
 *
 * @package  Foundation
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
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

    /** La funzione inserisciServizio inserisce un oggetto EServizio nel database.
     * @param EServizio $es l'oggetto EServizio da inserire nel db.
     */
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

    /** La funzione cancellaServizio cancella una ennupla rappresentante un servizio dal database
     * @param Eservizio $es L'oggetto EServizio che si vuole eliminare dal db.
     */
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

    /** La funzione aggiornaServizio cerca di modificare una ennupla della tabella servizio prendendo come input un
     * oggetto di tipo EServizio.
     * @param Eservizio $es
     */
    public function aggiornaServizio(Eservizio $es) {
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
        $valori = parent::cambiaChiaviArray($es->getArrayAttributi());
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

    /** La funzione caricaServizioDaDb effettua una query sulla tabella servizio e crea un oggetto EServizio corrispondente
     * ai valori trovati.
     * @param $key int l'id del servizio cercato
     * @return bool | EServizio L'oggetto EServizio corrispondente all'id selezionato.
     */
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

    /** La funzione caricaServizi carica dalla tabella servizio tutti i servizi presenti e restituisce un array di oggetti
     * EServizio
     * @return array (EServizio) Array rappresentante tutti i servizi presenti sul database.
     */
    public function caricaServizi() {
        $result = parent::caricaTutte($this->table);
        $arrSer = array();
        foreach($result as $ser) {
            $serElem = $this->caricaServizioDaDb($ser['nomeServizio']);
            array_push($arrSer,$serElem);
        }
        return $arrSer;
    }

}