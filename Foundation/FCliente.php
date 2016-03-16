<?php

class FCliente extends Fdb  {
    
    public function __construct() {
        $this->_table = 'clienti';
        $this->_key = 'IDC';
        $this->_return_class = 'ECliente';
    }
    
    public function store($oggetto) {
        $query='INSERT INTO `'.$this->_table.'` '
                .'VALUES ('.$oggetto->getID().')';
        //TODO
    }
    
    // Nessun metodo load per adesso dato che ECliente non ha ancora un'implementazione
    
    // Nessun metodo update perchè la tabella 'clienti' contiene solo 'IDC'
}
