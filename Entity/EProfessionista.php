<?php

class EProfessionista extends EUtente {

    private $serviziOfferti = [];
    private $settore = [];
    private $orari;
    private $agendaLavoro;
        
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $id, &$so, $set, $or, &$al) {  // ricontrollare se va bene &$so
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrari($or);
        $this->agendaLavoro=$al;     // non avrebbe senso un metodo per settare un agenda, dato che ogni prof ha un'unica agenda
                                     // $al passato per riferimento   
    }
    
    public function setServiziOfferti(&$so) {       // passaggio per riferimento
        $this->serviziOfferti = [];
        foreach ($so as $servizio) {
            controllaEsistenza($so, "servizio");
            array_push($this->serviziOfferti, &$servizio);      //passaggio per riferimento
        }
    }
    
    public function setSettore($set) {
        $this->settore = [];
        foreach ($set as $value) {
            controllaEsistenza($set, "settore");
            array_push($this->settore, $value);
        }
    }
    
    public function setOrari($or) {
        $pattern = "#^(2[0-3]|[01][0-9]):([0-5][0-9])?#";
        if(preg_match($pattern, $or) != 1) {
            throw new Exception("Orario non valido", 1);
        }
        $this->orari = $or;
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
    
    public function aggiungiServizio(&$so) {
        controllaEsistenza($so, "servizio");
        array_push($this->serviziOfferti, $so);
    }
    
    public function aggiungiSettore($set) {
        if(count($this->settore) > 3) {
            throw new Exception("Limite settori raggiunto", 2);
        }
        controllaEsistenza($set, "settore");
        array_push($this->settore, $set);
    }
    
    public function rimuoviServizio($so) {
        controllaEsistenza($so, "servizio");
        if(($key = array_search($so, $this->serviziOfferti)) !== false) {
            unset($this->serviziOfferti[$key]);
            $this->serviziOfferti = array_values($this->serviziOfferti);
        }
        else {
            throw new Exception ("Servizio non presente", 2);
        }
    }
    
    // Da finire, ma forse meglio in Foundation
    private function controllaEsistenza($servizio, $tipo) {
        //controlla l'esistenza di un servizio o di un settore e ritorna true o false
        if($tipo === "servizio") {      // cerca tra i servizi
            ;
        }
        else if ($tipo === "settore") { // cerca tra i settori
            ;
        } 
        else {
            throw new Exception("Tipo non valido", 2);
        }
    }
}

// Bisogna fare test per verificare la correttezza dei passaggi per riferimento
