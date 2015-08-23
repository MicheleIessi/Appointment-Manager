<?php

class EAppuntamento {
    
    // Attributi
    private $data;          // Stringa divisa da "/"
    private $orario;        // Stringa di due orari divisi da "-"
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
        $this->data=$d;
    }
    
    public function setOrario($o)    {
        $this->orario=$o;
    }
    
    public function setVisita($v)    {
        
        if (is_null($this->visita))     {
            $this->visita = new EServizio();    // Costruttore di default
        }
        
        if( !( is_a($v, EServizio)))    {    
            throw new Exception("Variabile non valida", 1);   }
        else    {
        $this->visita=$v;   // Composizione 
        }
    }
    
    public function setIDCliente($IDC)    {
        $this->IDCliente=$IDC;
    }
    
    public function setIDProfessionista($IDP)   {
        $this->IDProfessionista=$IDP;
    }
    
    public function getData()   {
        return $this->data;
    }
    
    public function getOrario()   {
        return $this->orario;
    }
    
    public function getVisita()   {
        return $this->visita;
    }
    
    public function getIDCliente()  {
        return $this->IDCliente;
    }
    
    public function getIDProfessionista()   {
        return $this->IDProfessionista;
    }
    
}
