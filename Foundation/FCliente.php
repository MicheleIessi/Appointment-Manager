<?php

class FCliente extends Fdb  {
    
    public function __construct() {
        $this->table = 'clienti';
        $this->_key = 'IDC';
        $this->return_class = 'ECliente';
        USingleton::getInstance('Fdb');
    }
    
    public function store($oggetto) {

        //TODO
    }
    
    // Nessun metodo load per adesso dato che ECliente non ha ancora un'implementazione
    
    // Nessun metodo update perchè la tabella 'clienti' contiene solo 'IDC'
}
