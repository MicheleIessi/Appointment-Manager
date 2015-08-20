<?php
    require 'EPersona.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EUtente
 *
 * @author Michele
 */
class EUtente extends EPersona {

    protected $email;
    protected $password;
    protected $numID;
    
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $n) {
        parent::__construct($n, $c, $dn, $cf, $s);
        $this->setEmail($e);
        $this->setPassword($p);
        $this->setID($n);
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
        if(strlent($p) > 20) {
            throw new Exception("Password troppo lunga", 1);
        }
        $this->password = $p;
    }

    public function setID($n) {
        
    }

}
