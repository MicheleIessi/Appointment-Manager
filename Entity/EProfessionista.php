<?php

/**
 * Class EProfessionista
 */
class EProfessionista extends EUtente {

    private $serviziOfferti = array();
    private $settore;
    private $orari;
    /** @var  EAgenda */
    private $agendaLavoro;



        
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id, $so, $set, $or) {
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrari($or);
        $this->setAgendaLavoro();
    }
    
    public function setServiziOfferti($so) {
        $this->serviziOfferti = array();
        foreach ($so as $servizio) {
            array_push($this->serviziOfferti, $servizio);
        }
    }
    
    public function setSettore($set) {
        $this->settore = $set;
    }
    //$or è una stringa rappresentante un qualsiasi numero di range di orari nel formato hh:mm-hh:mm separati da virgole
    public function setOrari($or) {
        $pattern = "#^((2[0-3]|[01][0-9]):([0-5][0-9])-(2[0-3]|[01][0-9]):([0-5][0-9]),?)+$#";
        $ore = explode(",", $or);
        foreach ($ore as $orario) {
            if(preg_match($pattern, $orario) == 1) {
                $this->orari = $or;
            }
            else
                throw new Exception("Orario non valido", 1);
        }
        $this->orari = $or;
    }
    
    public function setAgendaLavoro() {
        //?
    }

    /**
     * @return array EServizio
     */
    public function getServiziOfferti()     {
        return $this->serviziOfferti;
    }
    
    public function getSettore()    {
        return $this->settore;
    }
    
    public function getOrari()  {
        return $this->orari;
    }
    
    public function getAgendaLavoro()   {
        return $this->agendaLavoro;
    }
    
    public function aggiungiServizio($so) {
        array_push($this->serviziOfferti, $so);
    }
    
    public function aggiungiSettore($set) {
        if(count($this->settore) > 3) {
            throw new Exception("Limite settori raggiunto", 2);
        }
        array_push($this->settore, $set);
    }
    
    public function rimuoviServizio($so) {
        if(($key = array_search($so, $this->serviziOfferti)) !== false) {
            unset($this->serviziOfferti[$key]);
            $this->serviziOfferti = array_values($this->serviziOfferti);
        }
        else {
            throw new Exception ("Servizio non presente", 2);
        }
    }
    private function convertiOraInBlocco($ora) {
        $arrayOra=explode(':',$ora);
        $bloccoOra=($arrayOra[0]*60)/$this->agendaLavoro->getDurataBlocco();
        $bloccoMinuti=($arrayOra[1]/$this->agendaLavoro->getDurataBlocco());
        $blocco=$bloccoOra+$bloccoMinuti;
        return $blocco;
    }

    public function getArrayAttributi() {
        return array($this->numID,$this->settore,$this->orari);
    }

    public function getUtenteDaProfessionista() {
        return new EUtente($this->getNome(),$this->getCognome(),$this->getDataNascita(),
                           $this->getCodiceFiscale(),$this->getSesso(),$this->getEmail(),
                           $this->getPassword(),$this->getID());
    }



}