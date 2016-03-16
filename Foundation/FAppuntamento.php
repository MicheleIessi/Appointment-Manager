<?php

class FAppuntamento extends Fdb  {
    
    public function __construct() {
        $this->_table='appuntamenti';
        $this->_key=['visita','IDC','IDP'];
        $this->_return_class='EAppuntamento';
    }

    public function load($key1,$key2,$key3) {


        $query = 'SELECT * FROM `'.$this->_table.'` WHERE `'.$this->_key[0].'`="'.$key1.'" AND `'
                                                                 .$this->_key[1].'`="'.$key2.'" AND `'
                                                                 .$this->_key[2].'`="'.$key3.'";';
        //echo $query;      debug
        $risQuery = $this->querydb($query)->fetch_array(MYSQLI_NUM);
        
        $d =   $risQuery[0];
        $o =   $risQuery[1];
        $temp = 'SELECT * FROM `servizi` WHERE `nomeServizio` = "'.$risQuery[2].'";';
        $risQueryServ = $this->querydb($temp)->fetch_array(\MYSQLI_NUM);
        $v = new EServizio($risQueryServ[0], $risQueryServ[1], $risQueryServ[2], $risQueryServ[3]);
        //echo "<br></br>".$v->getStringaAttributi();   debug
        $idc = $risQuery[3];
        $idp = $risQuery[4];
        $appuntamento= new EAppuntamento($d,$o,$v,$idc,$idp);
        return $appuntamento;
    }
    
    public function delete($key1,$key2,$key3) {     
        $this->connessione= FConnectionDB::connetti();
        $query= 'DELETE FROM `'.$this->nomeTabella.'` WHERE `'.$this->nomeChiave[0].'`="'.$key1.'" AND `'
                                                                .$this->nomeChiave[1].'`="'.$key2.'" AND `'
                                                                .$this->nomeChiave[2].'`="'.$key3.'";';
        //echo "<br></br>".$query;      debug
        return $this->querydb($query);
    }
    
    public function update($d,$o,$v,$idc,$idp,$key1,$key2,$key3)  {      // Da testare
        $arrayVariabili=  array (   '`data`'=>$d,
                                    '`orario`'=>$o,
                                    '`visita`'=>$v,
                                    '`IDC`'=>$idc,
                                    '`IDP`'=>$idp
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
        //echo "<br></br>".$stringaTotale;      DEBUG
        $query= 'UPDATE `appuntamenti` SET '.$stringaTotale.' WHERE `visita`="'.$key1.'" AND `IDC`="'.$key2.'" AND `IDP`="'.$key3.'";';
        //echo "<br></br>".$query;              DEBUG
        $this->connessione=  FConnectionDB::connetti();
        $this->querydb($query);
    }
    
}
