<?php
    include_once 'EPersona.php';

class EUtente extends EPersona {

    protected $email;
    protected $password;
    protected $numID;
    
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id) {
        parent::__construct($n, $c, $dn, $cf, $s);
        $this->setEmail($e);
        $this->setPassword($p);
        $this->setID($id);
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

    public function setID($n) {
        $pattern = "#^[0-9]{6}#";
        if(preg_match($pattern, $n) != 1) {
            throw new Exception("ID non valido", 1);
        }
        $this->numID = $n;
    }
    
    public function getEmail()    { return $this->email;    }
    public function getPassword() { return $this->password; }
    public function getID()       { return $this->numID;    }
}
