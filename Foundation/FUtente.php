<?php

class FUtente extends Fdb   {
    
    public function __construct() {
        $this->nomeTabella = 'utenti';
        $this->nomeChiave = 'numID';
        $this->nomeClasseRitorno = 'EUtente';
    }
    
    public function load($key) {
        $risQuery = parent::load($key);
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
    
    public function update($n,$c,$dn,$cf,$s,$e,$p,$id,$key)  {      // Da testare
        $arrayVariabili=  array (   '`nome`'=>$n,
                                    '`cognome`'=>$c,
                                    '`dataNascita`'=>$dn,
                                    '`codiceFiscale`'=>$cf,
                                    '`sesso`'=>$s,
                                    '`email`'=>$e,
                                    '`password`'=>$p,
                                    '`numID`'=>$id
        );
        $stringaValori='';
        $cont = 0;
        $chiavi = array_keys($arrayVariabili);
        foreach ($arrayVariabili as $variabile) {
            if($variabile!=null)    {
                $stringaValori.=$chiavi[$cont].'="'.$variabile.'", ';
                $cont++;
            }
        }
        $stringaTotale=  substr($stringaValori, 0, sizeof($stringaValori)-3);
        $query= 'UPDATE `utenti` SET '.$stringaTotale.' WHERE `numID`="'.$key.'";';
        $this->connessione=  FConnectionDB::connetti();
        $this->querydb($query);
    }
    
    

            
}
    
 
