<?php


/**
 * Fdb rappresenta la classe foundation più 'vicina' al database, e come tale si occupa di gestire tutte le query.
 * È l'unica classe in cui sono presenti codici SQL.
 *
 * @package  Foundation
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class Fdb {
    /**
     * @var $db PDO
     */
    protected static $db;              //Variabile per la connessione al database
    private $result;                   //Variabile contenente il risultato dell'ultima query
    protected $table;                  //Variabile contenente il nome della tabella
    protected $primary_key;            //Variabile contenente le chiavi primarie della tabella
    protected $attributi;              //Variabile contenente gli attributi della tabella
    protected $return_class;           //Variabile contenente il tipo di classe da restituire
    protected $bind;                   //Per i prepared statements
    protected $bind_key;               //Per i prepared statements
    protected $old_keys;               //Per i prepared statements
    private static $set = false;       //Per assicurare che ci sia al massimo una connessione per volta
    private $last_id;

    /**
     * Fdb constructor. In realtà ci sono due costruttori e questa funzione sceglie quale usare a seconda del numero
     * di parametri che le si passano.
     */
    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i))
        {
            call_user_func_array(array($this,$f),$a);
        }
        else throw new Exception("Costruttore invalido FDB");
    }

    /** Il costruttore con 4 parametri. È usato solo una volta al momento del setup.
     * @param $dbms string Il dbms che si vuole usare (di default è mysql)
     * @param $dbhost string L'indirizzo dell'host su cui risiederà il database usato dall'applicazione
     * @param $dbuser string L'username usato per la connessione al database
     * @param $dbpass string La password usata per la connessione al database
     */
    public function __construct4($dbms,$dbhost,$dbuser,$dbpass) {
        $dsn = "$dbms:host=$dbhost;";
        $user = $dbuser;
        $pass = $dbpass;
        $attr = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$set = true;
        try {
            self::$db = new PDO($dsn,$user,$pass,$attr);
        } catch(PDOException $e) {
            die("Impossibile connettersi al database 5: ".$e->getMessage());
        }
    }

    /**
     * Il costruttore con 0 parametri. Usa i parametri presi dal file di configurazione.
     */
    public function __construct0() {
        require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/config.inc.php');
        /** @var string $dbms è la stringa che specifica il db che si usa nel file di configurazione */
        /** @var string $config è il file di configurazione*/
        /* ho scritto queste 2 righe perché l'ide mi diceva che erano variabili sconosciute */
        $dsn = "$dbms:host=".$config[$dbms]['hostname'].";dbname=".$config[$dbms]['database'];
        $user = $config[$dbms]['username'];
        $pass = $config[$dbms]['password'];
        $attr = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$set=true;
        try {
            self::$db = new PDO($dsn,$user,$pass,$attr);
        } catch(PDOException $e) {
            die("Impossibile connettersi al database: ".$e->getMessage()); }
    }

    /** Il metodo 'inserisci' prende in input un array associativo con elementi del tipo {[:nomeAttributo]=>valore} e usa
     * gli attributi degli oggetti Foundation che si estendono da Fdb per fare una query corretta di tipo INSERT in base
     * ai bind e ai nomi di attributi corretti.
     * @param $data array associativo usato per il funzionamento corretto dei prepared statements
     * @return bool l'esito della query
     */
    protected function inserisci($data) {
        $BindKey = array_keys($data);
        $attributi = explode(',',$this->attributi);
        $sql = "INSERT INTO $this->table (";
        foreach($attributi as $attr) {
            $sql.= "$attr,";
            }
        $sql = rtrim($sql,',');
        $sql.= ") VALUES (";
        foreach($BindKey as $key) {
            $sql.= "$key,";
        }
        $sql = rtrim($sql,',');
        $sql.=")";
        //echo $sql;
        $query=self::$db->prepare($sql);
        try {
            self::$db->beginTransaction();
            $this->result = $query->execute($data);
            $this->last_id = self::$db->lastInsertId();
            self::$db->commit();
        } catch (PDOException $e) {
            self::$db->rollBack();
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    /** Il metodo 'cancella' prende in input un array associativo con elementi del tipo {[:nomeAttributo]=>valore} e usa
     * gli attributi degli oggetti Foundation che si estendono da Fdb per fare una query corretta di tipo DELETE in base
     * ai bind e ai nomi di attributi corretti.
     * @param $data array associativo usato per il funzionamento corretto dei prepared statements
     * @return int il numero di rows coinvolte.
     */
    protected function cancella($data) {
        $sql="DELETE FROM $this->table WHERE";
        $BindKey = explode(',',$this->bind_key);
        $Primary = array_map(function($v) { return ltrim($v, ':');}, $BindKey);
        $imax=count($Primary);
        for($i=0;$i<$imax;$i++) {
            $sql.=" $Primary[$i] = $BindKey[$i] AND";
        }
        $sql = rtrim($sql,'AND');
        $query=self::$db->prepare($sql);
        $rows=0;
        try {
            $this->result = $query->execute($data);
            $rows = $query->rowCount();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $rows;
    }

    /** Il metodo 'aggiorna' prende in input un array associativo con elementi del tipo {[:nomeAttributo]=>valore} e usa
     * gli attributi degli oggetti Foundation che si estendono da Fdb per fare una query corretta di tipo UPDATE in base
     * ai bind e nomi di attributi corretti.
     * @param $data array associativo usato per il funzionamento corretto dei prepared statements
     * @return int il numero di rows coinvolte.
     */
    protected function aggiorna($data) {
        $j = 0;
        $imax=count($data);
        $attr = explode(',',$this->attributi);
        $chiaviAttr = array_keys($data);
        $sql = "UPDATE $this->table SET ";
        while($j<$imax) {
            $sql.=" $attr[$j] = ".$chiaviAttr[$j].",";
            $j++;
        }
        $sql = rtrim($sql,',');
        $sql.=" WHERE";
        $Primary = explode(',',$this->primary_key);
        $BindOldKey = explode(',',$this->old_keys);
        $imax=count($Primary);
        for($i=0;$i<$imax;$i++) {
            $sql.=" $Primary[$i] = '".$BindOldKey[$i]."' AND";
        }
        $sql = rtrim($sql,'AND');
        //echo $sql;
        $query = self::$db->prepare($sql);
        $rows=0;
        try {
            $this->result = $query->execute($data);
            $rows = $query->rowCount();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $rows;
    }

    /** Il metodo 'carica' prende in input un array associativo con elementi del tipo {[:nomeAttributo]=>valore} e usa
     * gli attributi degli oggetti Foundation che si estendono da Fdb per fare una query corretta di tipo SELECT in base
     * ai bind e nomi di attributi corretti.
     * @param $data array associativo usato per il funzionamento corretto dei prepared statements
     * @return mixed array associativo che le classi Foundation useranno per creare oggetti Entity
     */
    protected function carica($data) {
        $sql="SELECT * FROM $this->table WHERE ";
        $Primary = explode(',',$this->primary_key);
        $BindKey = explode(',',$this->bind_key);
        $imax=count($Primary);
        for($i=0;$i<$imax;$i++) {
            $sql.=" $Primary[$i] = $BindKey[$i] AND";
        }
        $sql = rtrim($sql,'AND');
        $query=self::$db->prepare($sql);
        try {
            $query->execute($data);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $this->result = $query->fetch();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    /** Il metodo isOn serve ad evitare che più istanze di Fdb vengano istanziate allo stesso momento.
     * @return bool true se c'è già un Fdb istanziata, false altrimenti.
     */
    protected static function isOn() {
        return self::$set;
    }

    /** Il metodo setParam si occupa di settare gli attributi di Fdb in maniera adatta per l'esecuzione di una query
     * sul database. Viene richiamato dalle classi che estendono da Fdb, che usano i propri parametri.
     * @param $tabella string La tabella su cui viene fatta la query
     * @param $chiavi string Gli attributi della tabella
     * @param $bindings string I bindings usati da Fdb per l'uso dei prepared statements
     * @param $bindkey string I bindings per le chiavi primarie della tabella
     * @param $oldkey string Parametro di supporto che serve se si vuole modificare la chiave primaria
     */
    protected function setParam($tabella,$chiavi,$bindings,$bindkey,$oldkey) {
        $this->table=$tabella;
        $this->attributi=$chiavi;
        $this->bind=$bindings;
        $this->bind_key=$bindkey;
        $this->old_keys=$oldkey;
    }

    /** Il metodo 'caricaConChiave' prende in input un array associativo con elementi del tipo [:nomeAttributo]=>valore
     * e usa una stringa passata come chiave alternativa per effettuare una query di tipo SELECT al database
     * @param $data array Array associativo usato per il funzionamento corretto dei prepared statements
     * @param $chiave string Stringa contenente una o più chiavi, separate da virgole
     * @return mixed Un result set contenente il risultato della select
     */
    protected function caricaConChiave($data,$chiave) {
        $sql="SELECT * FROM $this->table WHERE ";
        $chiaveArr = explode(',',$chiave);
        $BindKey = array_keys($data);
        $imax=count($BindKey);
        for($i=0;$i<$imax;$i++) {
            $sql.=" $chiaveArr[$i] = $BindKey[$i] AND";
        }
        $sql = rtrim($sql,'AND');
        $query=self::$db->prepare($sql);
        try {
            $query->execute($data);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $this->result = $query->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    /** La funzione inserisciGenerica effettua una query di tipo INSERT prendendo come input la tabella su cui farla
     * @param $data array Array associativo usato per il funzionamento corretto dei prepared statements
     * @param $table string La tabella su cui effettuare la insert
     * @return bool true se la query è andata a buon fine, false altrimenti
     */
    protected function inserisciGenerica($data,$table) {
        $BindKey = array_keys($data);
        $sql = "INSERT INTO $table VALUES (";
        foreach($BindKey as $key) {
            $sql.= "$key,";
        }
        $sql = rtrim($sql,',');
        $sql.=")";
        //echo "$sql<br>";
        $query = self::$db->prepare($sql);
        try {
            $this->result = $query->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $this->result;
    }

    /** La funzione caricaGenerica effettua una query di tipo SELECT prendendo come input la tabella su cui farla
     * @param $data array Array associativo usato per il funzionamento corretto dei prepared statements
     * @param $table string La tabella su cui effettuare la select
     * @param $chiavi string Stringa contenente una o più chiavi, separate da virgole
     * @return mixed Un result set contenente il risultato della select
     */
    protected function caricaGenerica($data,$table,$chiavi) {
        $sql="SELECT * FROM $table WHERE ";
        $Primary = explode(',',$chiavi);
        $BindKey = array_keys($data);
        $imax=count($Primary);
        for($i=0;$i<$imax;$i++) {
            $sql.=" $Primary[$i] = $BindKey[$i] AND";
        }
        $sql = rtrim($sql,'AND');
        $query=self::$db->prepare($sql);
        try {
            $query->execute($data);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $this->result = $query->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    /**La funzione caricaTutte effettua una query di tipo SELECT * in una tabella in input
     * @param $table string La tabella per il quale si vogliono caricare tutte le tuple
     * @return array Array di result set, ogni elemento dell'array corrisponde a una tupla
     */
    protected function caricaTutte($table) {
        $sql="SELECT * FROM $table";
        $query=self::$db->prepare($sql);
        try {
            $query->execute();
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $this->result=$query->fetchAll();
        } catch(PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
        return $this->result;
    }

    /** Il metodo cambiaChiaviArray serve per cambiare gli indici di un array rendendolo un array associativo di tipo
     * $array[':attributo'] = valore. Questa configurazione dell'array associativo serve a garantire il corretto
     * funzionamento dei prepared statements.
     * @param $arr array L'array per cui cambiare gli indici
     * @return mixed
     */
    protected function cambiaChiaviArray($arr) {
        $chiavi = explode(',',$this->bind);
        $imax = count($arr);
        for($i=0;$i<$imax;$i++) {
            $arr[$chiavi[$i]] = $arr[$i];
            unset($arr[$i]);
        }
        return $arr;
    }

    /** La funzione getLastID ritorna l'id acquisito dall'ultima ennupla inserita nel database. È necessario creare una
     * funzione per questo, poiché dopo una commit() la funzione PDO lastInsertId restituisce sempre 0.
     * @return mixed l'id dell'ultima insert
     */
    public function getLastID() {
        return $this->last_id;
    }

    /** La funzione query serve solo in caso di setup a creare il db. È possibile usarla solo se non esiste il file
     * di configurazione, ovvero solamente durante il setup.
     * @param $sql string una stringa SQL usata per effettuare una query.
     * @return PDOStatement Il risultato generico della query
     */
    public function query($sql) {
        if(!file_exists("includes/config.inc.php"))
            return self::$db->query($sql);
    }
}
?>