<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EPersona
 *
 * @author Michele
 */

class EPersona {
    
    protected $nome;
    protected $cognome;
    protected $dataNascita;
    protected $codiceFiscale;
    protected $sesso;
    
    public function __construct($n, $c, $dn, $cf, $s) {
        $this->setNome($n);
        $this->setCognome($c);
        $this->setDN($dn);
        $this->setCF($cf);
        $this->setSesso($s);
    }

    public function setNome($n) {
        $ne = explode(" ", $n);
        $pattern = "#^([a-zA-Zàèìòù]{0,}[ ']{0,1})[a-zA-Zàèìòù]{0,}$#";
        foreach ($ne as $parola) {
            if(preg_match($pattern, $parola)!= 1) {
                throw new Exception("Nome non valido", 1);
            }
        }
        $this->nome = $n;
    }
    
    public function setCognome($c) {
        $ce = explore(" ", $c);
        $pattern = "#^([a-zA-Zàèìòù]{0,}[ ']{0,1})[a-zA-Zàèìòù]{0,}$#";
        foreach ($ce as $parola) {
            if(preg_match($pattern, $parola) != 1) {
                throw new Exception("Cognome non valido", 1);
            }
        }
        $this->cognome = $c;
    }
    
    public function setDN($dn) {
        list($d,$m,$y) = explode("/", $dn);
        if(!checkdate($m, $d, $y)) {
                throw new Exception("Data non valida", 1);
        }
        $this->dataNascita = $dn;
    }
    
    public function setCF($cf) {
        $pattern = "#^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$#";
        if(preg_match($pattern, $cf) != 1) {
            throw new Exception("Codice fiscale non valido", 1);
        }
        $this->codiceFiscale = $cf;
    }
    
    public function setSesso($s) {
        $pattern = "#^[mMfF]$#";
        if(preg_match($pattern, $s) != 1) {
            throw new Exception("Sesso non valido", 1);
        }
        $this->sesso = $s;
    }
    //metodi get
    public function getNome()    { return $this->nome;          } 
    public function getCognome() { return $this->cognome;       }
    public function getDN()      { return $this->DN;            }
    public function getCF()      { return $this->codiceFiscale; }
    public function getSesso()   { return $this->sesso;         }
}
