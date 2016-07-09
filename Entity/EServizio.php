<?php
/**
* EServizio e' una classe del package Entity
*
* EServizio e' la classe invocatata nel momento in cui bisogna definire
* un nuovo servizio che determinati professionisti possono offrire 
* example: medico,avvocato,... 
* 
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
     * 
     * @param $nom,$des,$set
     */
    public function setNomeServizio($nom) { $this->nomeServizio=$nom; }
    public function setDescrizione($des) { $this->descrizione=$des; }
    public function setSettore($set) { $this->settore=$set; }
    /**
     * 
     * @param $dur
     * Viene effettuato un controllo sul formato della durata del
     * servizio
     * 
     */
    public function setDurata($dur) {
        $pattern = "#^([2][0-3]|[01][0-9]|[0-9]):([0-5][0-9]):([0-5][0-9])$#";
        if(preg_match($pattern, $dur) === 1)
            $this->durata = $dur;
        else
            echo "Durata del servizio non valida.<br>";
    }
    /**
     * 
     * @return type
     */
    public function getNomeServizio() { return $this->nomeServizio; }
    public function getDescrizione() { return $this->descrizione; }
    public function getSettore() { return $this->settore; }
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