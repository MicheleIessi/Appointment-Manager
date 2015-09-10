<?php

class FProfessionista extends Fdb {
    
    public function __construct() {
        $this->nomeTabella = 'professionisti';
        $this->nomeChiave = 'IDP';
        $this->nomeClasseRitorno = 'EProfessionista';
    }
    
    public function store($oggetto) {
        if(!is_a($oggetto, $this->nomeClasseRitorno))   {
            die("Errore, l'oggetto passato non è compatibile.");
        }
        $this->connessione= FConnectionDB::connetti();
        $stringaSettori="";
        $j=count($oggetto->settore);
        for($i=0; $i<=$j-1; $i++)    {
            if($i<$j-1) {
                $stringaSettori.=$oggetto->settore[i].", ";
            }
            $stringaSettori.=$oggetto->settore[i];
        }
        $query='INSERT INTO `'.$this->nomeTabella.'` '
                .'VALUES ('.$oggetto->getID().', '.$stringaSettori.', '.$oggetto->getOrari().')';
        return $this->querydb($query);
    }
    
    
    
    
}
