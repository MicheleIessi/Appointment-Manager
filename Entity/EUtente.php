<?php

class EUtente extends EPersona {

    protected $email;
    protected $password;
    protected $numID;
    static $totID = 0;
    
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id) {
        parent::__construct($n, $c, $dn, $cf, $s);
        $this->setEmail($e);
        $this->setPassword($p);
        if($id==null)   {
            EUtente::$totID++;
            $this->numID=EUtente::$totID;   // Per istanziare nuovi oggetti
        }
        else    {
            $this->numID=$id;       // Per istanziare oggetti già creati in precedenza senza incrementare $totID
        }
    }

    public function setEmail($e) {
        $pattern = "#^[a-zA-Z0-9]{1,20}@[a-zA-Z]{1,10}\.[a-zA-Z]{1,5}$#";
        if (preg_match($pattern, $e) != 1) {
            throw new Exception("E-Mail non valida", 1);
        }
        $this->email = $e;
    }

    public function setPassword($p) {
        if(strlen($p) < 8) {
            throw new Exception("Password troppo corta", 1);
        }
        if(strlen($p) > 20) {
            throw new Exception("Password troppo lunga", 1);
        }
        $this->password = $p;
    }
    
    /*
    public function setID($n) {
        $pattern = "#^[0-9]{6}#";
        if(preg_match($pattern, $n) != 1) {
            throw new Exception("ID non valido", 1);
        }
        $this->numID = $n;
    }
    */
    
    public function getEmail()    { return $this->email;    }
    public function getPassword() { return $this->password; }
    public function getID()       { return $this->numID;    }
    
    // Metodo di utilità per il lato Foundation
    public function getStringaAttributi()   {
        $s = "'".$this->getNome()."', ".
             "'".$this->getCognome()."', ".
             "'".$this->getDN()."', ".
             "'".$this->getCF()."', ".
             "'".$this->getSesso()."', ".
             "'".$this->getEmail()."', ".
             "'".$this->getPassword()."', ".
             "'".$this->getID()."'";
        return $s;
    }
}
