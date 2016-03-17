<?php

/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 16/03/2016
 * Time: 09:51
 */

class Fdb {
    /**
     * @var PDO Variabile di connessione al database
     */
    protected $db;
    private $result;                   //Variabile contenente il risultato dell'ultima query
    protected $table;                  //Variabile contenente il nome della tabella
    protected $primary_key;            //Key della tabella
    protected $attributi;              //Variabile contenente gli attributi della tabella
    protected $return_class;           //Variabile contenente il tipo di classe da restituire
    protected $auto_increment=false;   //Variabile booleana tabella con chiave automatica o no
    protected $bind;                   //Per i prepared statements
    protected $bind_key;               //Per i prepared statements

    public function __construct() {

        require_once("includes/config.inc.php");

        $dsn = "$dbms:host=".$config[$dbms]['hostname'].";dbname=".$config[$dbms]['database'];

        $user = $config[$dbms]['username'];
        $pass = $config[$dbms]['password'];
        $attr = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $this->db = new PDO($dsn,$user,$pass,$attr);

            echo "Connesso al db"."<br>";
        } catch(PDOException $e) {
            die("Impossibile connettersi al database: ".$e->getMessage()); }
    }

    protected function inserisci($data) {
        $query=$this->db->prepare("INSERT INTO ".$this->table.'('.$this->attributi.") VALUES (".$this->bind.")");
        try {
            $this->result = $query->execute($data);
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    protected function cancella($data) {
        $query=$this->db->prepare("DELETE FROM ".$this->table." WHERE ".$this->primary_key."=".$this->bind_key);
        try {
            $this->result = $query->execute($data);
            $rows = $query->rowCount();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $rows;
    }


    protected function close() {
        $this->_connection = null;
    }

    protected function setParam($tabella,$chiavi,$bindings,$bindkey)
    {
        $this->table=$tabella;
        $this->key=$chiavi;
        $this->bind=$bindings;
        $this->bind_key=$bindkey;
    }

    protected function cambiaChiaviArray($arr) {
        $chiavi= explode(',',$this->bind);
        $imax=count($arr);
        for($i=0;$i<$imax;$i++) {
            $arr[$chiavi[$i]] = $arr[$i];
            unset($arr[$i]);
        }
        return $arr;
    }

    protected function getDb() {
        if($this->db instanceof PDO)
            return $this->db;
    }
}
?>