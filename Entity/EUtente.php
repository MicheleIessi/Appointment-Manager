<?php

class EUtente {
    protected $numID=null;  //solo lato db?
    protected $nome;
    protected $cognome;
    protected $dataNascita;
    protected $codiceFiscale;
    protected $sesso;
    protected $email;
    protected $password;
    private static $totID = 1;
    
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id) {
        $this->setNome($n);
        $this->setCognome($c);
        $this->setDataNascita($dn);
        $this->setCodFis($cf);
        $this->setSesso($s);
        $this->setEmail($e);
        $this->setPassword($p);

    }

    public function setNome($n) {
        $pattern="#^[a-zA-Z ]{1,30}$#";
        if(preg_match($pattern,$n) != 1) {
            throw new Exception("Nome non valido");
        }
        $this->nome = $n;
    }

    public function setCognome($c) {
        $pattern="#^[a-zA-Z\' ]{1,30}$#";
        if(preg_match($pattern,$c) != 1) {
            throw new Exception("Cognome non valido");
        }
        $this->cognome = $c;
    }

    public function setDataNascita($dn) {
        $pattern="#^(\d{4})-(0[1-9]|1[0-2])-([1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern,$dn) != 1) {
            throw new Exception("Data di nascita non valida");
        }
        $this->dataNascita = $dn;
    }

    public function setCodFis($cf) {
        $pattern="#^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$#";
        if(preg_match($pattern,$cf) != 1) {
            throw new Exception("Codice fiscale non valido");
        }
        $this->codiceFiscale=$cf;
    }

    public function setSesso($s) {
        $pattern="#^[mMfF]$#";
        if(preg_match($pattern,$s) != 1) {
            throw new Exception("Sesso non valido");
        }
        $this->sesso=$s;
    }

    public function setEmail($e) {
        $pattern = "#^[a-zA-Z0-9]{1,20}@[a-zA-Z]{1,10}\.[a-zA-Z]{1,5}$#";
        if (preg_match($pattern, $e) != 1) {
            throw new Exception("E-Mail non valida", 1);
        }
        $this->email = $e;
    }

    public function setPassword($p) {
        if(strlen($p) < 8 || strlen($p) > 20) {
            throw new Exception("La password deve essere lunga da 8 a 20 caratteri");
        }
        $this->password = $p;
    }
    
    public function setID($n) {
        $pattern = "#^[0-9]{1,6}#";
        if(preg_match($pattern, $n) != 1) {
            throw new Exception("ID non valido", 1);
        }
        $this->numID = $n;
    }
    public function getNome()           { return $this->nome; }
    public function getCognome()        { return $this->cognome; }
    public function getDataNascita()    { return $this->dataNascita; }
    public function getCodiceFiscale()  { return $this->codiceFiscale; }
    public function getSesso()          { return $this->sesso; }
    public function getEmail()          { return $this->email; }
    public function getPassword()       { return $this->password; }
    public function getID()             { return $this->numID; }

    // Metodo di utilità per il lato Foundation

}
