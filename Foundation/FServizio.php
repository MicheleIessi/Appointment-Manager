<?php

class FServizio extends Fdb     {
    
    public function load($key) {
        parent::load($key);
        $ns =   $risQuery[0];
        $des =    $risQuery[1];
        $s =    $risQuery[2];
        $dur =    $risQuery[3];
        $servizio= new EServizio($ns,$des,$s,$dur);
        return $servizio;
    }
}
