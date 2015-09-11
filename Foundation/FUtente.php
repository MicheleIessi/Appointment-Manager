<?php

class FUtente extends Fdb   {
    
    public function __construct() {
        $this->nomeTabella = 'utenti';
        $this->nomeChiave = 'numID';
        $this->nomeClasseRitorno = 'EUtente';
    }
    
    public function load($key) {
        parent::load($key);
        $n= $risQuery[0];
        $c= $risQuery[1];
        $dn=$risQuery[2];
        $cf=$risQuery[3];
        $s= $risQuery[4];
        $e= $risQuery[5];
        $p= $risQuery[6];
        $id=$risQuery[7];
        $utente= new EUtente($n,$c,$dn,$cf,$s,$e,$p,$id);
        return $utente;
    }
    
    
    
    
}
