<?php

class FAppuntamento extends Fdb  {

    public function load($key) {
        parent::load($key);
        $d =   $risQuery[0];
        $o =   $risQuery[1];
        $v =   $risQuery[2];
        $idc = $risQuery[3];
        $idp = $risQuery[4];
        $appuntamento= new EAppuntamento($d,$o,$v,$idc,$idp);
        return $appuntamento;
    }
    
}
