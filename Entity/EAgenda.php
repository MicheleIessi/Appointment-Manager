<?php
class EAgenda {
    
    // Attributi
    private $impegni=[];
    private $blocchi;
    private $chiaviBlocchi;     // contiene le chiavi dell'array $blocchi; serve nei metodi di modifica dei blocchi
    
    // Costruttore
    public function __construct($i) {
        $this->setBlocchi(); 
        $this->setChiaviBlocchi();
        $this->setImpegni($i);
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
    
    /* Nell'agenda ad ogni blocco può essere associata una delle seguenti stringhe:
       'L' (libero), 'O' (occupato), 'NA' (non disponibile). Un blocco 'L' può essere usato per 
       l'inserimento di un appuntamento, un blocco 'O' è già occupato da un appuntamento,
       un blocco 'NA' non è disponibile in quanto fuori dall'orario di lavoro del professionista
    */
    
    public function setBlocchi()    {       // Metodo per il riempimento dell'array blocchi; le chiavi sono gli orari
        $this->blocchi['00:00'] = 'L';
        $this->blocchi['00:30'] = 'L';
        $this->blocchi['01:00'] = 'L';
        $this->blocchi['01:30'] = 'L';
        $this->blocchi['02:00'] = 'L';
        $this->blocchi['02:30'] = 'L';
        $this->blocchi['03:00'] = 'L';
        $this->blocchi['03:30'] = 'L';
        $this->blocchi['04:00'] = 'L';
        $this->blocchi['04:30'] = 'L';
        $this->blocchi['05:00'] = 'L';
        $this->blocchi['05:30'] = 'L';
        $this->blocchi['06:00'] = 'L';
        $this->blocchi['06:30'] = 'L';
        $this->blocchi['07:00'] = 'L';
        $this->blocchi['07:30'] = 'L';
        $this->blocchi['08:00'] = 'L';
        $this->blocchi['08:30'] = 'L';
        $this->blocchi['09:00'] = 'L';
        $this->blocchi['09:30'] = 'L';
        $this->blocchi['10:00'] = 'L';
        $this->blocchi['10:30'] = 'L';
        $this->blocchi['11:00'] = 'L';
        $this->blocchi['11:30'] = 'L';
        $this->blocchi['12:00'] = 'L';
        $this->blocchi['12:30'] = 'L';
        $this->blocchi['13:00'] = 'L';
        $this->blocchi['13:30'] = 'L';
        $this->blocchi['14:00'] = 'L';
        $this->blocchi['14:30'] = 'L';
        $this->blocchi['15:00'] = 'L';
        $this->blocchi['15:30'] = 'L';
        $this->blocchi['16:00'] = 'L';
        $this->blocchi['16:30'] = 'L';
        $this->blocchi['17:00'] = 'L';
        $this->blocchi['17:30'] = 'L';
        $this->blocchi['18:00'] = 'L';
        $this->blocchi['18:30'] = 'L';
        $this->blocchi['19:00'] = 'L';
        $this->blocchi['19:30'] = 'L';
        $this->blocchi['20:00'] = 'L';
        $this->blocchi['20:30'] = 'L';
        $this->blocchi['21:00'] = 'L';
        $this->blocchi['21:30'] = 'L';
        $this->blocchi['22:00'] = 'L';
        $this->blocchi['22:30'] = 'L';
        $this->blocchi['23:00'] = 'L';
        $this->blocchi['23:30'] = 'L';
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
            $this->blocchi[$cerca] = $valore;   // valore è 'O', 'L' o 'NA' -> inserire controllo
        }
        else if(is_string($ora)) {
            $this->blocchi[$ora] = $valore;
        }
        else {
            throw new Exception("Valore non valido in cambia blocco", 1);
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
        $intervallo = explode('-', $appuntamento->getOrario());
        $i= array_search($intervallo[0], $this->chiaviBlocchi);     // Ora inizio
        $f= array_search($intervallo[1], $this->chiaviBlocchi);     // Ora fine
        
        for($ora=$i; $ora<$f; $ora++  )    {
            if( $this->blocchi[ $this->chiaviBlocchi["$ora"] ] != 'L' )   {
                throw new Exception ('Errore, uno o più blocchi occupati', 1);
            }
            else    {
                for($ora=$i; $ora<$f; $ora++  )    {
                    $this->blocchi[ $this->chiaviBlocchi["$ora"] ] = 'O';
                }
            }
        }
    }
    
    private function eliminaBlocchi($appuntamento)  {
        $intervallo = explode('-', $appuntamento->getOrario());
        $i= array_search($intervallo[0], $this->chiaviBlocchi);     // Ora inizio
        $f= array_search($intervallo[1], $this->chiaviBlocchi);     // Ora fine
        
        for($ora=$i; $ora<$f; $ora++  )    {
            $this->blocchi[ $this->chiaviBlocchi["$ora"] ] = 'L';
        }
    }
    
    
}