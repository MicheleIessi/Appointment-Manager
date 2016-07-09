<?php   

/**
* EUtente e' la classe principale del package Entity
*
* EUtente e' la classe invocata ogni volta che bisogna creare degli
* oggetti utente
*
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
*/
            
class EUtente {
    
    //Attributi
    protected $numID=null;
    protected $nome;
    protected $cognome;
    protected $dataNascita;
    protected $codiceFiscale;
    protected $sesso;
    protected $email;
    protected $password;
    protected $codiceConferma ;
    
    //Costruttore
    public function __construct($n, $c, $dn, $cf, $s, $e, $p,$cc,$numID=null) {
        $this->setID($numID);
        $this->setNome($n);
        $this->setCognome($c);
        $this->setDataNascita($dn);
        $this->setCodFis($cf);
        $this->setSesso($s);
        $this->setEmail($e);
        $this->setPassword($p);
        $this->setCodiceConferma($cc);
    }
    /**
     * 
     * @param $cc
     */
    public function setCodiceConferma($cc){
        $this->codiceConferma=$cc;
    }
    /**
     * 
     * @param $n
     * @throws Exception
     */
            
    public function setNome($n) {
        $pattern="#^[a-zA-Zàèéìòù \']{1,20}$#";
        if(preg_match($pattern,$n) != 1) {
            throw new Exception("Errore: formato nome non valido");
        }
        $this->nome = $n;
    }
    /**
     * 
     * @param $c
     * @throws Exception
     */
    public function setCognome($c) {
        $pattern="#^[a-zA-Zàèéìòù\' ]{1,20}$#";
        if(preg_match($pattern,$c) != 1) {
            throw new Exception("Errore: formato cognome non valido");
        }
        $this->cognome = $c;
    }
    /**
     * 
     * @param $dn
     * @throws Exception
     */
    public function setDataNascita($dn) {
        
        $pattern="#^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern,$dn) != 1) {
            throw new Exception("Errore: formato data di nascita non valido1");
        }
        /**
         * viene diviso l'array e validato il giorno del mese
         */
        $dataNascita= explode("-", $dn);
        $anno= $dataNascita[0];
        $mese= $dataNascita[1];
        $giorno= (int)$dataNascita[2];
        /**
         * mese e giorno vengono controllati insieme per stabilire eventuali anomalie
         * attraverso le eccezzioni
         */       
        switch ($mese)  {
        
            case "04" || "06" || "09" || "11": { 
                if($giorno>30)    {
                    throw new Exception("Il mese scelto non ha più di 30 giorni.");
                }
            }

            case "02":  {
                if($anno%4==0 && $anno%400!=0)  {   // controllo se l'anno è bistestile
                    if($giorno>29)    {
                        throw new Exception("Febbraio non ha più di 29 giorni nell'anno $anno.");
                    }
                }
                else {
                    if($giorno>28) {
                        throw new Exception("Febbraio non ha più di 28 giorni nell'anno $anno.");
                    }
                }
            }
        }
            
        /**
         * Non c'è bisogno di fare i controlli sugli altri mesi, perchè per l'espressione
         * regolare nessun giorno può uscire dall'intervallo 01-31
         * Successivamente si effettua un controllo sull'eta :
         * ->deve essere nato dopo l'inizio del secolo
         * ->deve essere maggiorene
         *          
         */
        $date = new DateTime($dn);
        $novecento = new DateTime('1900-01-01');
        $diciotto = new DateTime();
        $diciotto->modify('-18 years');
        if( $date < $novecento || $date > $diciotto )  {
            throw new Exception("Errore: formato data di nascita non valido");
        }
        /**
         * se tutti i controlli sono andati a buon fine 
         * viene settata la data di nascita
         */   
        $this->dataNascita = $dn;
    }
    /**
     * 
     * @param $cf
     * @throws Exception
     * Effettua un controllo sulla validita del codice fiscale
     */
    public function setCodFis($cf) {
        $pattern="#^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$#";
        if(preg_match($pattern,$cf) != 1) {
            throw new Exception("Errore: formato codice fiscale non valido");
        }
        $this->codiceFiscale=$cf;
    }
    /**
     * 
     * @param $s
     * @throws Exception
     * 
     */
    public function setSesso($s) {
        $pattern="#^[mMfF]$#";
        if(preg_match($pattern,$s) != 1) {
            throw new Exception("Errore: formato sesso non valido");
        }
        $this->sesso=$s;
    }
    /**
     * 
     * @param $e
     * @throws Exception
     * Effettua un controllo sulla validita del formato e-mail
     */
    public function setEmail($e) {
        $pattern = "#^[a-zA-Z0-9]{1,30}@[a-zA-Z]{1,10}\.[a-zA-Z]{1,5}$#";
        if (preg_match($pattern, $e) != 1) {
            throw new Exception("Errore: formato email non valido");
        }
        $this->email = strtolower($e);
    }
    /**
     * 
     * @param $p
     * @throws Exception
     * La password deve aver piu di 8 carratteri e meno di 20
     */
    public function setPassword($p) {
        if(strlen($p) < 8 || strlen($p) > 20) {
            throw new Exception("Errore: formato password non valido");
        }
        $this->password = $p;
    }
    /**
     * 
     * @param $n
     * @throws Exception
     * Viene settato l'id dell'utente che deve rispettare un certo numero
     */

    public function setID($n) {
        if(!is_null($n)) {
            $pattern = "#^[0-9]{1,6}#";
            if (preg_match($pattern, $n) != 1) {
                throw new Exception("Errore: ID non valido", 1);
            }
        }
        $this->numID = $n;
    }
    /**
     * 
     * @return type
     */
    public function getNome()           { return $this->nome; }
    public function getCognome()        { return $this->cognome; }
    public function getDataNascita()    { return $this->dataNascita; }
    public function getCodiceFiscale()  { return $this->codiceFiscale; }
    public function getSesso()          { return $this->sesso; }
    public function getEmail()          { return $this->email; }
    public function getPassword()       { return $this->password; }
    public function getID()             { return $this->numID; }
    public function getCodiceConferma() { return $this->codiceConferma;}
    /**
     * "Metodo di utilita' utilizzato per il lato foundation"
     * La funzione getArrayAttributi ritorna un array contente gli attributi di 
     * un oggetto Eutente
     * @return array
     */
    public function getArrayAttributi() {
        return array($this->numID,$this->nome,$this->cognome,$this->dataNascita,
            $this->codiceFiscale,$this->sesso,$this->email,$this->password,$this->codiceConferma);
    }
}