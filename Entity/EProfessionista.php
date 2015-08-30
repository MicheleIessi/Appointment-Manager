<?php
class EProfessionista extends EUtente {

    private $serviziOfferti = [];
    private $settore = [];
    private $orari;
    private $agendaLavoro;
        
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id, &$so, $set, $or) {  // ricontrollare se va bene &$so
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrari($or);
        $this->setAgendaLavoro();
    }
    
    public function setServiziOfferti($so) {       // passaggio per riferimento
        $this->serviziOfferti = [];
        foreach ($so as $servizio) {
            array_push($this->serviziOfferti, $servizio);      //passaggio per riferimento
        }
    }
    
    public function setSettore($set) {
        $this->settore = [];
        foreach ($set as $value) {
            array_push($this->settore, $value);
        }
    }
    
    public function setOrari($or) {
        $pattern = "#^(2[0-3]|[01][0-9]):([0-5][0-9])$#";
        $ore = explode("-", $or);
        foreach ($ore as $orario) {
            if(preg_match($pattern, $orario) != 1) {
                throw new Exception("Orario non valido", 1);
            }
        }
        $this->orari = $or;
    }
    
    public function setAgendaLavoro() {
        $this->agendaLavoro = new EAgenda([]);
        $intervallo = explode('-', $this->orari);
        $i= array_search($intervallo[0], $this->agendaLavoro->getChiaviBlocchi());     // Ora inizio
        $f= array_search($intervallo[1], $this->agendaLavoro->getChiaviBlocchi());     // Ora fine
        echo "<br>". $i . "<- inizio <br> ".$f."<- fine";
        $ora = 0;
        
        foreach ($this->agendaLavoro->getBlocchi() as $blocco) {
            if($ora >= $i && $ora < $f) {
                $this->agendaLavoro->cambiaBlocco($ora, false);
            }
            else {
                $this->agendaLavoro->cambiaBlocco($ora, null);
            }
            $ora++;

        }       
    }
    
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
}