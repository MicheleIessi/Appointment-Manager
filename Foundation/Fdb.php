<?php
// Classe da cui erediteranno tutte le altre
class Fdb {
    // Attributi
    protected $connessione;
    protected $nomeTabella;
    protected $nomeChiave;
    protected $nomeClasseRitorno;
    
    // Costruttore di default
    
    // Metodi 
    public function querydb($query) { 
        $risultato= $this->connessione->query($query);
        if($risultato==false)   {
            die('Errore nella composizione della query. ');
        }
        return $risultato;
    }
    
    public function store($oggetto) {       //metodo store usato da FUtente, FServizio e FAppuntamento
        if(!is_a($oggetto, $this->nomeClasseRitorno))   {
            die("Errore, l'oggetto passato non è compatibile.");
        }
        $this->connessione= FConnectionDB::connetti();
        $query = 'INSERT INTO `'.$this->nomeTabella.'` VALUES ('.$oggetto->getStringaAttributi.');';
        return $this->querydb($query);
    }
    
}