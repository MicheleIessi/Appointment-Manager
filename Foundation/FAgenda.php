<?php

use FConnectionDB;

class FAgenda {
    
        private $connessione;
        private $nomeChiave;
        private $nomeClasseRitorno;
        
        public function __construct() {
            $this->nomeChiave='IDP';
            $this->nomeClasseRitorno='EAgenda';
        }
        
        public function load($key)  {   // Da testare
            $this->connessione= FConnectionDB::connetti();
            $query = 'SELECT * FROM `appuntamenti` WHERE `'.$this->nomeChiave.'`='.$key.';';
            $risQuery = $this->querydb($query)->fetch_all(MYSQLI_NUM);
            foreach ($risQuery as $app)    {
                $d=$app[0];
                $o=$app[1];
            
                $temp=$this->connessione->query('SELECT * FROM `servizi` WHERE `nomeServizio`='.$app[2].';')->fetch_all(MYSQLI_NUM);
                $v=new EServizio($temp[0], $temp[1], $temp[2], $$temp[3]);  // E' un servizio
            
                $idc=$app[3];
                $idp=$app[4];
            
                $appuntamento=[];
                array_push($appuntamento, new EAppuntamento($d,$o,$v,$idc,$idp));
            }
        $agenda= new EAgenda($appuntamento);
        return $agenda;
        }
        
}
