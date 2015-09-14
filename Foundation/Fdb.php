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
            die('Errore, composizione della query errata o risultato nullo ');
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
    
    public function load($key)  {
        $this->connessione= FConnectionDB::connetti();
        $query = 'SELECT * FROM `'.$this->nomeTabella.'` WHERE `'.$this->nomeChiave.'`='.$key.';';
        $risQuery = $this->querydb($query)->fetch_array(MYSQLI_NUM);     // Otteniamo un array con indici numerici
        // Da qui in poi ogni metodo figlio si comporterà in modo diverso
    }
    
    public function delete($key)    {
        $this->connessione= FConnectionDB::connetti();
        $query= 'DELETE * FROM `'.$this->nomeTabella.'` WHERE `'.$this->nomeChiave.'`='.$key.';';
        return $this->querydb($query);
    }
    
}