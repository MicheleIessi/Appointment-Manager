<?php

class FAppuntamento extends Fdb  {
    
    public function __construct() {
        $this->nomeTabella='appuntamenti';
        $this->nomeChiave=['visita','IDC','IDP'];
        $this->nomeClasseRitorno='EAppuntamento';
    }

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
    
    public function delete($key1,$key2,$key3) {     // Problema nel db
        $this->connessione= FConnectionDB::connetti();
        $query= 'DELETE * FROM `'.$this->nomeTabella.'` WHERE `'.$this->nomeChiave[0].'`='.$key1.', `'
                                                                .$this->nomeChiave[1].'`='.$key2.', `'
                                                                .$this->nomeChiave[2].'`='.$key3.', ';
        return $this->querydb($query);
    }
    
    public function update($d,$o,$v,$idc,$idp,$key1,$key2,$key3)  {      // Da testare
        $arrayVariabili=  array (   `data`=>$d,
                                    `orario`=>$o,
                                    `visita`=>$v,
                                    `IDC`=>$idc,
                                    `IDP`=>$idp
        );
        $stringaValori='';
        foreach ($arrayVariabili as $variabile) {
            if($variabile!=null)    {
                $stringaValori.=key($arrayVariabili)."='".$variabile."', ";
            }
        }
        $stringaTotale=  substr($stringaValori, 0, sizeof($stringaValori)-2);
        $query= 'UPDATE `appuntamenti` SET '.$stringaTotale.' WHERE `visita`='.$key1.', `IDC`='.$key2.', `IDP`='.$key3.';';
        $this->connessione=  FConnectionDB::connetti();
        $this->querydb($query);
    }
    
}
