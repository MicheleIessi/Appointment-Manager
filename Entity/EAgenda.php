<?php
class EAgenda {
    
    // Attributi
<<<<<<< HEAD
    private $impegni=[];
    private $blocchi;
    private $chiaviBlocchi;     // contiene le chiavi dell'array $blocchi; serve nei metodi di modifica dei blocchi
    private $ampiezza=30;
    
=======
    private $impegni=[];        // è un array di EAppuntamento
    private $durataBlocco;      // in minuti, può essere 10, 20 30 o 60
    private $settimana;

>>>>>>> origin/master
    // Costruttore
    public function __construct($i,$d) {
        $this->setImpegni($i);
        $this->setDurataBlocco($d);
        $this->setSettimanaLavorativa();
    }
    
    // Metodi
    public function setImpegni($i)  {   // $i è un array di oggetti della classe EAppuntamento
        foreach ($i as $appuntamenti) {     
            if( !( is_a($appuntamenti, "EAppuntamento") ) )    {    
                throw new Exception("Variabile non valida", 1);
            }
            $this->aggiungiAppuntamento($appuntamenti);
        }
    }
    
<<<<<<< HEAD
    public function setBlocchi()    {       // Metodo per il riempimento dell'array blocchi; le chiavi sono gli orari

         //durata del quanto di tempo
        $blocchi=60/$this->ampiezza*24;

        $settimana = array('lun'=> array(),
                           'mar'=> array(),
                           'mer'=> array(),
                           'gio'=> array(),
                           'ven'=> array(),
                           'sab'=> array(),
                           'dom'=> array());

        foreach($settimana as $giorno) {
            $giorno = array_fill(0,$blocchi,'NA');
        }

        $this->blocchi['00:00'] = false;//0
        $this->blocchi['00:30'] = false;//1
        $this->blocchi['01:00'] = false;//2
        $this->blocchi['01:30'] = false;
        $this->blocchi['02:00'] = false;
        $this->blocchi['02:30'] = false;
        $this->blocchi['03:00'] = false;
        $this->blocchi['03:30'] = false;
        $this->blocchi['04:00'] = false;
        $this->blocchi['04:30'] = false;
        $this->blocchi['05:00'] = false;//10
        $this->blocchi['05:30'] = false;
        $this->blocchi['06:00'] = false;
        $this->blocchi['06:30'] = false;
        $this->blocchi['07:00'] = false;
        $this->blocchi['07:30'] = false;
        $this->blocchi['08:00'] = false;
        $this->blocchi['08:30'] = false;
        $this->blocchi['09:00'] = false;//18
        $this->blocchi['09:30'] = false;
        $this->blocchi['10:00'] = false;
        $this->blocchi['10:30'] = false;
        $this->blocchi['11:00'] = false;
        $this->blocchi['11:30'] = false;
        $this->blocchi['12:00'] = false;
        $this->blocchi['12:30'] = false;
        $this->blocchi['13:00'] = false;
        $this->blocchi['13:30'] = false;
        $this->blocchi['14:00'] = false;
        $this->blocchi['14:30'] = false;
        $this->blocchi['15:00'] = false;
        $this->blocchi['15:30'] = false;
        $this->blocchi['16:00'] = false;
        $this->blocchi['16:30'] = false;
        $this->blocchi['17:00'] = false;
        $this->blocchi['17:30'] = false;
        $this->blocchi['18:00'] = false;
        $this->blocchi['18:30'] = false;
        $this->blocchi['19:00'] = false;
        $this->blocchi['19:30'] = false;
        $this->blocchi['20:00'] = false;
        $this->blocchi['20:30'] = false;
        $this->blocchi['21:00'] = false;
        $this->blocchi['21:30'] = false;
        $this->blocchi['22:00'] = false;
        $this->blocchi['22:30'] = false;
        $this->blocchi['23:00'] = false;
        $this->blocchi['23:30'] = false;
    }


    private function setChiaviBlocchi() {
        $this->chiaviBlocchi = array_keys($this->blocchi);
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
        if( !( is_a($a, 'EAppuntamento') ) )    {
            throw new Exception('Variabile non valida', 1);
        }
        else {
            $this->aggiungiBlocchi($a);
            array_push($this->impegni, $a);
            }
    }

    public function cambiaBlocco($ora, $valore) {
        if(is_int($ora)) {
            $cerca = $this->chiaviBlocchi[$ora];
            $this->blocchi[$cerca] = $valore;   //valore è false o null
        }
        else if(is_string($ora)) {
            $this->blocchi[$ora] = $valore;
        }
        else {
            throw new Exception("Valore non valido in cambia blocco", 1);
=======
    public function setDurataBlocco($d) {       //ricontrollare
        if($d!=(10 or 20 or 30 or 60))    {
        throw new Exception('Durata non valida', 1);
        }
        $this->durataBlocco=$d;
    }
    
    public function setSettimanaLavorativa() {
        /* 
        Nell'agenda ad ogni blocco può essere associata una delle seguenti stringhe:
        'D' (disponibile), 'O' (occupato), 'NA' (non disponibile). Un blocco 'L' può essere usato per 
        l'inserimento di un appuntamento, un blocco 'O' è già occupato da un appuntamento,
        un blocco 'NA' non è disponibile in quanto fuori dall'orario di lavoro del professionista
        */
        
        $blocchi=(60/$this->durataBlocco)*24;
        $str = 'NA';
        
        $sett = array(
            'lun'=> array_fill(0,$blocchi,$str),
            'mar'=> array_fill(0,$blocchi,$str),
            'mer'=> array_fill(0,$blocchi,$str),
            'gio'=> array_fill(0,$blocchi,$str),
            'ven'=> array_fill(0,$blocchi,$str),
            'sab'=> array_fill(0,$blocchi,$str),
            'dom'=> array_fill(0,$blocchi,$str)
            );
        $this->settimana=$sett;
        
        /*  Prova:
        foreach($settimana as $giorno) {
            print_r($giorno);
            echo "<br>";
            echo "<br>";
        */
    }

    public function getImpegni()    {
        return $this->impegni;
    }
    
    public function getDurataBlocco()   {
        return $this->durataBlocco;
    }
    
    public function getSettimana()  {
        return $this->settimana;
    }
    
    public function aggiungiAppuntamento($a)    {    // $a è un oggetto della classe EAppuntamento
        if( !( is_a($a, "EAppuntamento") ) )    {    
            throw new Exception("Variabile non valida", 1);
>>>>>>> origin/master
        }
        array_push($this->impegni, $a);
    }
    
<<<<<<< HEAD
    public function rimuoviAppuntamento($a) {          // Nota: lancia il metodo eliminaBlocchi
        //unset( $this->impegni[ array_search($a, $impegni) ] );
        //eliminaBlocchi($a);
        $temp=array_values($this->impegni);
        $this->impegni=$temp;
    }    
    
    // Metodi di classe (privati) per il controllo della non sovrapposizione degli impegni e la modifica di $blocchi
    private function aggiungiBlocchi($appuntamento) {
        $intervallo = explode('-', $appuntamento->getOrario());
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
=======
    public function eliminaAppuntamento($a) {           // ricontrollare
        unset(array_search($a, $this->impegni));
>>>>>>> origin/master
    }
    
    
    
    
    
}