<?php
// Classe da cui erediteranno tutte le altre
class Fdb {
    
    
    private $connessione;
    protected $nomeTabella;
    protected $nomeChiave;
    protected $nomeClasseRitorno;
    protected $auto_increment;
    
    public function __construct() {
        $this->connessione = new FConnectionDB();
    }
    
    
    public function query($query) {        
        
        
    }
    
    
}