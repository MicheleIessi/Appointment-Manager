<?php

class FProfessionista extends Fdb {
    
    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table='professionisti';
        $this->primary_key='IDP';
        $this->attributi='IDP,settore,orari';
        $this->return_class='EProfessionista';
        $this->bind=':IDP,:settore,:orari';
        $this->bind_key=':IDP';
        $this->old_keys;
    }
    
    public function inserisciProfessionista(EProfessionista $pro) {

    }





    
    
}
