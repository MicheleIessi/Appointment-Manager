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
    
    public function load($key) {        // Da testare 
        parent::load($key);
        $idp=   $risQuery[0];
        $sett= explode("-", $risQuery[1]);   // è un array
        $orari= $risQuery[2];
        
        $datiProf=$this->querydb('SELECT * FROM `utenti` WHERE `numID`='.$key.';')->fetch_array(MYSQLI_NUM);
        $n= $datiProf[0];
        $c= $datiProf[1];
        $dn=$datiProf[2];
        $cf=$datiProf[3];
        $s= $datiProf[4];
        $e= $datiProf[5];
        $p= $datiProf[6];
        // $id=$datiProf[7];
        
        // fetch_all per inserire in un array con chiavi numeriche tutte le ennuple restituite
        $so=$this->querydb('SELECT `nomeServizio` FROM `serviziOfferti` WHERE `numID`='.$key.';')->fetch_all(MYSQLI_NUM); 
        $professionista= new EProfessionista($n,$c,$dn,$cf,$s,$e,$p,$idp,$so,$sett,$orari);
        return $professionista;
    }
    
    
    
    
}
