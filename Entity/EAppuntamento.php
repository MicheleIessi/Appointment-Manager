<?php

class EAppuntamento {
    
    // Attributi
    private $IDAppuntamento;
    private $data;          // Stringa divisa da "-"
    private $orarioInizio;        // Stringa
    private $visita;        // E' un Servizio
    private $IDCliente;
    private $IDProfessionista;
    
    /* Visita può essere passato per valore, infatti se un dato oggetto della classe Eservizio cambia, 
    tale cambiamento non dovrebbe, per scelta progettuale, influenzare appuntamenti che usavano quel servizio
    prima che venisse modificato     */
    
    // Costruttore
    public function __construct($IDP,$IDC,$d,$o,$v,$IDApp=0) {
        $this->setIDProfessionista($IDP);
        $this->setIDCliente($IDC);
        $this->setData($d);
        $this->setOrarioInizio($o);
        $this->setVisita($v);
        $this->setIDAppuntamento($IDApp);
    }
    
    // Metodi (aggiungere controlli)
    public function setIDAppuntamento($IDApp) {
        $this->IDAppuntamento = $IDApp;
    }

    public function setData($d)    {
        $pattern = "#^(\d{4})-(0[1-9]|1[0-2])-([1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern, $d) != 1) {
            throw new PDOException("Data non valida", 1);
        }
        $this->data = $d;
    }
    
    public function setOrarioInizio($o)    {
        $pattern = "#^(2[0-3]|[01][0-9]|[1-9]):([0-5][0-9]):([0-5][0-9])#";
        if(preg_match($pattern, $o) != 1) {
            throw new PDOException("Orario non valido: inserire un orario tra 00:00:00 e 23:59:59");
        }
        $this->orarioInizio = $o;
    }
    
    public function setVisita($v)    {
        if (is_null($this->visita))     {
            $this->visita = new EServizio(null,null,null,0);    // Costruttore di default
        }
        if(!(is_a($v, "EServizio")))    {
            throw new PDOException("Variabile non valida: deve essere un'istanza di EServizio, variabile di tipo ".gettype($v)." passata.");
        }
        else {
            $this->visita=$v;   // Composizione
        }
    }
    
    public function setIDCliente($IDC) {
        $pattern = '#^([0-9]){1,6}$#';
        if(preg_match($pattern, $IDC) != 1) {
            throw new PDOException("ID Cliente non valido.");
        }
        $this->IDCliente = $IDC;
    }

    public function setIDProfessionista($IDP) {
        $pattern = "#^[0-9]{1,6}$#";
        if(preg_match($pattern, $IDP) != 1) {
            throw new PDOException("ID Professionista non valido.");
        }
        $this->IDProfessionista=$IDP;
    }
    public function getIDAppuntamento() { return $this->IDAppuntamento; }
    public function getData() { return $this->data; }
    public function getOrario() { return $this->orarioInizio; }
    public function getVisita() { return $this->visita; }
    public function getIDCliente() { return $this->IDCliente; }
    public function getIDProfessionista() { return $this->IDProfessionista; }
    
    // Metodo di utilità per il lato Foundation
    public function getArrayAttributi() {
        if($this->IDAppuntamento !==0 )
            return array($this->IDAppuntamento,$this->IDProfessionista,$this->IDCliente,$this->data,$this->orarioInizio,$this->visita);
        else
            return array($this->IDProfessionista,$this->IDCliente,$this->data,$this->orarioInizio,$this->visita);

    }
}