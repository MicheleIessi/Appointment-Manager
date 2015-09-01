<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FConnectionDB
 *
 * @author Davide
 */
class FConnectionDB {
    
    private $host;
    private $user;
    private $password;
    private $database;
    
    public function __construct() {
        global $config;
        $this->host = $config['mysql']['host'];
        $this->user = $config['mysql']['user'];
        $this->password = $config['mysql']['password'];
        $this->database = $config['mysql']['database'];
    }
    
    public function connetti() {
        $db = new mysqli($this->host,$this->user,$this->password,$this->database);
        if($db->connect_errno > 0) {
            die("Connessione non riuscita [" . $db->connect_error . "]");
            }
            return $db;
        }
    
    public function disconnetti(mysqli $db) {

        $db->close();
        
    }    
    
}