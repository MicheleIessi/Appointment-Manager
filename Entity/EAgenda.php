<?php

class EAgenda {
    
    // Attributi
    private $impegni;
    private $blocchi;
    private $chiaviBlocchi;     // contiene le chiavi dell'array $blocchi; serve nei metodi di modifica dei blocchi
    
    // Costruttore
    public function __construct(&$i) {
        $this->impegni=setImpegni($i);
        $this->blocchi=setBlocchi(); 
        $this->chiaviBlocchi=setChiaviBlocchi();
    }
    
    // Metodi
    public function setImpegni($i)  {   // $i è un array di oggetti della classe EAppuntamento
        foreach ($i as $appuntamenti) {     
            if( !( is_a($appuntamenti, EAppuntamento) ) )    {    
            throw new Exception("Variabile non valida", 1);
            }
        }
        $this->impegni=$i;
    }
    
    public function setBlocchi()    {       // Metodo per il riempimento dell'array blocchi; le chiavi sono gli orari
        $this->blocchi['00:00']->false;
        $this->blocchi['00:30']->false;
        $this->blocchi['01:00']->false;
        $this->blocchi['01:30']->false;
        $this->blocchi['02:00']->false;
        $this->blocchi['02:30']->false;
        $this->blocchi['03:00']->false;
        $this->blocchi['03:30']->false;
        $this->blocchi['04:00']->false;
        $this->blocchi['04:30']->false;
        $this->blocchi['05:00']->false;
        $this->blocchi['05:30']->false;
        $this->blocchi['06:00']->false;
        $this->blocchi['06:30']->false;
        $this->blocchi['07:00']->false;
        $this->blocchi['07:30']->false;
        $this->blocchi['08:00']->false;
        $this->blocchi['08:30']->false;
        $this->blocchi['09:00']->false;
        $this->blocchi['09:30']->false;
        $this->blocchi['10:00']->false;
        $this->blocchi['10:30']->false;
        $this->blocchi['11:00']->false;
        $this->blocchi['11:30']->false;
        $this->blocchi['12:00']->false;
        $this->blocchi['12:30']->false;
        $this->blocchi['13:00']->false;
        $this->blocchi['13:30']->false;
        $this->blocchi['14:00']->false;
        $this->blocchi['14:30']->false;
        $this->blocchi['15:00']->false;
        $this->blocchi['15:30']->false;
        $this->blocchi['16:00']->false;
        $this->blocchi['16:30']->false;
        $this->blocchi['17:00']->false;
        $this->blocchi['17:30']->false;
        $this->blocchi['18:00']->false;
        $this->blocchi['18:30']->false;
        $this->blocchi['19:00']->false;
        $this->blocchi['19:30']->false;
        $this->blocchi['20:00']->false;
        $this->blocchi['20:30']->false;
        $this->blocchi['21:00']->false;
        $this->blocchi['21:30']->false;
        $this->blocchi['22:00']->false;
        $this->blocchi['22:30']->false;
        $this->blocchi['23:00']->false;
        $this->blocchi['23:30']->false;
    }
    
    private function setChiaviBlocchi() {
        array_keys($this->blocchi);
    }
    
    public function getImpegni()    {
        return $this->impegni;
        }
        
    public function getBlocchi()    {
        return $this->blocchi;
    }
    
    public function getChiaviBlocchi()      {
        return $this->chiaviBlocchi;
    }
    
    public function aggiungiAppuntamento($a)    {       // Nota: lancia il metodo aggiungiBlocchi
        if( !( is_a($a, EAppuntamento) ) )    {    
            throw new Exception('Variabile non valida', 1);
        }
        else {
            aggiungiBlocchi($a);
            array_push($this->impegni, $a);
            }
    }
    
    public function rimuoviAppuntamento($a) {          // Nota: lancia il metodo eliminaBlocchi
        unset( $this->impegni[ array_search($a, $impegni) ] );
        eliminaBlocchi($a);
        $temp=array_values($this->impegni);
        $this->impegni=$temp;
    }
    
    
    // Metodi di classe (privati) per il controllo della non sovrapposizione degli impegni e la modifica di $blocchi
    private function aggiungiBlocchi($appuntamento) {
        $intervallo = explode('-', $appuntamento->orario);
        $i= array_search($intervallo[0], $this->chiaviBlocchi);     // Ora inizio
        $f= array_search($intervallo[1], $this->chiaviBlocchi);     // Ora fine
        
        for($ora=$i; $ora<$f; $ora++  )    {
            if( $this->blocchi[ $this->chiaviBlocchi["$ora"] ] ==true )    {
                throw new Exception ('Errore, uno o più blocchi occupati', 1);
            }
            else    {
                for($ora=$i; $ora<$f; $ora++  )    {
                    $this->blocchi[ $this->chiaviBlocchi["$ora"] ] = true;
                }
            }
        }
    }
    
    private function eliminaBlocchi($appuntamento)  {
        $intervallo = explode('-', $appuntamento->orario);
        $i= array_search($intervallo[0], $this->chiaviBlocchi);     // Ora inizio
        $f= array_search($intervallo[1], $this->chiaviBlocchi);     // Ora fine
        
        for($ora=$i; $ora<$f; $ora++  )    {
            $this->blocchi[ $this->chiaviBlocchi["$ora"] ] = false;
        }
    }
    
    
}