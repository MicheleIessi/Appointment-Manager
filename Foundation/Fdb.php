<?php

// Classe da cui erediteranno tutte le altre

class Fdb {
    
    
    private $_connection;
    private $_result;
    protected $_table;
    protected $_key;
    protected $_auto_increment;
    protected $_return_class;
    
    
    public function __construct() {
        global $config;
        $this->connect($config['mysql']['host'], $config['mysql']['password'], $config['mysql']['user'], $config['mysql']['database']);      
    }
    
    /*
     * La funzione connect crea una connessione al db
     */
    public function connect($host, $user, $password, $database) {
        $this->_connection = mysqli_connect($host, $user, $password);
        if(!$this->_connection) {
            die("Impossibile connettersi al database.");
        }
        $db_selected = mysqli_select_db($this->_connection, $database);
        if(!$db_selected) {
            die("Impossibile usare il database.");
        }       
        return true;
    }
    
    /*
     * La funzione query effettua una query al db 
     */
    public function query($query) {
        
        $this->_result = mysqli_query($this->_connection, $query);
        if(!$this->_result) {
            return false;
        }
        else {
            return true;
        }
        
    }
    
    public function store() {
        
    }
    
   

    public function close() {
        mysqli_close($this->_connection);
    }
}
