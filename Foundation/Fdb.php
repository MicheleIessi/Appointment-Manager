<?php

/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 16/03/2016
 * Time: 09:51
 */

class Fdb_prova {

    private $_connection;               //Variabile di connessione al database
    private $_result;                   //Variabile contenente il risultato dell'ultima query
    protected $_table;                  //Variabile contenente il nome della tabella
    protected $_key;                    //Variabile contenente la chiave della tabella
    protected $_return_class;           //Variabile contenente il tipo di classe da restituire
    protected $_auto_increment=false;   //Variabile booleana tabella con chiave automatica o no

    public function __construct() {

        global $config;
        global $dbms;

        $dsn = "$dbms:host={$config[$dbms]['hostname']};dbname={$config[$dbms]['database']}";
        $user = $config[$dbms]['username'];
        $pass = $config[$dbms]['password'];

        $this->connect($dsn,$user,$pass);
    }

    public function connect($dsn,$user,$pass) {
        try {
            $this->_connection = new PDO($dsn,$user,$pass);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->query('SET names \'utf8\'');
            echo ('Connesso al database <br>');
        } catch(PDOException $e) {
            $this->close();
            die("Impossibile connettersi al database: ".$e->getMessage()); }
    }

    public function query($sql) {

        $this->_result=$this->_connection->query($sql);
        return $this->_result;
    }

    public function store($obj) {






    }

    public function close() {
        $this->_connection = null;
    }
}
?>