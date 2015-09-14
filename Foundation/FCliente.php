<?php

class FCliente extends Fdb  {
    
    public function __construct() {
        $this->nomeTabella = 'clienti';
        $this->nomeChiave = 'IDC';
        $this->nomeClasseRitorno = 'ECliente';
    }
    
    public function store($oggetto) {
        $query='INSERT INTO `'.$this->nomeTabella.'` '
                .'VALUES ('.$oggetto->getID().')';
        return $this->querydb($query);
    }
    
    // Nessun metodo load per adesso dato che ECliente non ha ancora un'implementazione
    
    // Nessun metodo update perchè la tabella 'clienti' contiene solo 'IDC'
}
