<?php

class FUtente extends Fdb   {
    
    public function __construct() {
        $this->nomeTabella = 'utenti';
        $this->nomeChiave = 'numID';
        $this->nomeClasseRitorno = 'EUtente';
    }
    
    
    
    
}
