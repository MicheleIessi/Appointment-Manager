<?php

class EAppuntamento {
    
    // Attributi
    private $data;          // Stringa divisa da "-"
    private $orario;        // Stringa di due orari divisi da ":'"
    private $visita;        // E' un Servizio
    private $IDCliente;
    private $IDProfessionista;
    
    /* Visita può essere passato per valore, infatti se un dato oggetto della classe Eservizio cambia, 
    tale cambiamento non dovrebbe, per scelta progettuale, influenzare appuntamenti che usavano quel servizio
    prima che venisse modificato     */
    
    // Costruttore
    public function __construct($d, $o, $v, $IDC, $IDP) {
        $this->setData($d);
        $this->setOrario($o);
        $this->setVisita($v);
        $this->setIDCliente($IDC);
        $this->setIDProfessionista($IDP);
    }
    
    // Metodi (aggiungere controlli)
    public function setData($d)    {
        $pattern = "#^(\d{4})-(0[1-9]|1[0-2])-([1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern, $d) != 1) {
            throw new Exception("Data non valida", 1);
        }
        $this->data = $d;
    }
    
    public function setOrario($o)    {
        $pattern = "#^(2[0-3]|[01][0-9]|[1-9]):([0-5][0-9])$#";   // pattern da cambiare se $o è nella forma '18-20'
        $ore = explode("-", $o);
        foreach ($ore as $orario) {
            if(preg_match($pattern, $orario) != 1) {
            throw new Exception("Orario non valido", 1);
            }
        }
        $this->orario = $o;
    }
    
    public function setVisita($v)    {
        if (is_null($this->visita))     {
            $this->visita = new EServizio(null,null,null,0);    // Costruttore di default
        }
        if( !( is_a($v, "EServizio")))    {    
            throw new Exception("Variabile non valida", 1);   }
        else    {
        $this->visita=$v;   // Composizione 
        }
    }
    
    public function setIDCliente($IDC) { $this->IDCliente=$IDC; }
    public function setIDProfessionista($IDP) { $this->IDProfessionista=$IDP; }
    public function getData() { return $this->data; }
    public function getOrario() { return $this->orario; }
    public function getVisita() { return $this->visita; }
    public function getIDCliente() { return $this->IDCliente; }
    public function getIDProfessionista() { return $this->IDProfessionista; }
    
    // Metodo di utilità per il lato Foundation
    public function getArrayAttributi() {
        return array($this->IDProfessionista,$this->IDCliente,$this->data,$this->orario,$this->visita);
    }
}
