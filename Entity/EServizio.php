<?php
/**
* EServizio e' una classe del package Entity
*
* EServizio e' la classe invocatata nel momento in cui bisogna definire
* una tipologia di colloquio professionale che determinati professionisti
* possono offrire.
* example: medico,avvocato,... 
*
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
 */

class EServizio {
    
    //Attributi    
    private $nomeServizio;
    private $descrizione;
    private $settore;
    private $durata;
    
    //Costruttore
    public function __construct($nom,$des, $set, $dur)   {
        $this->setNomeServizio($nom);
        $this->setDescrizione($des);
        $this->setSettore($set);
        $this->setDurata($dur);
    }
    /**
     * Imposta il nome del servizio.
     * @param $nom string Il nome del servizio.
     */
    public function setNomeServizio($nom) { $this->nomeServizio=$nom; }

    /**
     * Imposta la descrizione del servizio.
     * @param $des string La descrizione del servizio.
     */
    public function setDescrizione($des) { $this->descrizione=$des; }

    /**
     * Imposta il settore del servizio.
     * @param $set string Il settore del servizio.
     */
    public function setSettore($set) { $this->settore=$set; }

    /**
     * Imposta la durata del servizio, se questa rispetta il pattern 'hh:mm:ss'.
     * @param $dur string La durata che si vuole impostare.
     */
    public function setDurata($dur) {
        $pattern = "#^([2][0-3]|[01][0-9]|[0-9]):([0-5][0-9]):([0-5][0-9])$#";
        if(preg_match($pattern, $dur) === 1)
            $this->durata = $dur;
        else
            echo "Durata del servizio non valida.<br>";
    }
    /**
     * Ritorna il nome del servizio.
     * @return string Il nome del servizio.
     */
    public function getNomeServizio() { return $this->nomeServizio; }

    /**
     * Ritorna la descrizione del servizio.
     * @return string La descrizione del servizio.
     */
    public function getDescrizione() { return $this->descrizione; }

    /**
     * Ritorna il settore a cui appartiene il servizio.
     * @return string Il settore.
     */
    public function getSettore() { return $this->settore; }

    /**
     * Ritrona la durata del servizio.
     * @return string La durata del servizio.
     */
    public function getDurata() { return $this->durata; }

    /**
     * Metodo di utilita per il lato Foundation
     * E' la stessa funzione di EUtente solo e' adattata ad EServizio
     * @return array
     */
    public function getArrayAttributi() {
        return array($this->nomeServizio,$this->descrizione,$this->settore,$this->durata);
    }

}