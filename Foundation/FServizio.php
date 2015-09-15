<?php

class FServizio extends Fdb     {
    
    public function __construct() {
        $this->nomeTabella= 'servizi';
        $this->nomeChiave= 'nomeServizio';
        $this->nomeClasseRitorno= 'EServizio';
    }
    
    public function load($key) {
        $risQuery = parent::load($key);
        $ns  = $risQuery[0];
        $des = $risQuery[1];
        $s   = $risQuery[2];
        $dur = $risQuery[3];
        $servizio= new EServizio($ns,$des,$s,$dur);
        return $servizio;
    }
    
    public function update($ns,$des,$s,$dur,$key)  {      // Da testare
        $arrayVariabili=  array (   '`nomeServizio`'=>$ns,
                                    '`descrizione`'=>$des,
                                    '`settore`'=>$s,
                                    '`durata`'=>$dur
        );
        $stringaValori='';
        $cont = 0;
        $chiavi = array_keys($arrayVariabili);
        foreach ($arrayVariabili as $variabile) {
            if($variabile!=null)    {
                $stringaValori.=$chiavi[$cont]."='".$variabile."', ";
                $cont++;
            }
        }
        $stringaTotale=  substr($stringaValori, 0, sizeof($stringaValori)-3);
        $query= 'UPDATE `servizi` SET '.$stringaTotale.' WHERE `nomeServizio`="'.$key.'";';
        $this->connessione=  FConnectionDB::connetti();
        $this->querydb($query);
    }
}
