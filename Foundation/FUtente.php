<?php

class FUtente extends Fdb   {
    
    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'utenti';
        $this->primary_key = 'numID';
        $this->return_class = 'EUtente';

    }
}
    
 
