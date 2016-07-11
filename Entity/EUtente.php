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
     * Imposta il codice di conferma.
     * @param $cc Il codice di conferma.
     */
    public function setCodiceConferma($cc){
        $this->codiceConferma=$cc;
    }
    /**
     * Imposta il nome, se questo rispetta un certo pattern.
     * @param $n string Il nome che si vuole impostare
     * @throws Exception Se il nome non rispetta il pattern.
     */
            
    public function setNome($n) {
        $pattern="#^[a-zA-Zàèéìòù \']{1,20}$#";
        if(preg_match($pattern,$n) != 1) {
            throw new Exception("Errore: formato nome non valido");
        }
        $this->nome = $n;
    }
    /**
     * Imposta il cognome, se questo rispetta un certo pattern.
     * @param $c string Il cognome che si vuole impostare
     * @throws Exception Se il cognome non rispetta il pattern.
     */
    public function setCognome($c) {
        $pattern="#^[a-zA-Zàèéìòù\' ]{1,20}$#";
        if(preg_match($pattern,$c) != 1) {
            throw new Exception("Errore: formato cognome non valido");
        }
        $this->cognome = $c;
    }
    /**
     * Imposta la data di nascita, se rispetta il pattern 'aaaa-mm-dd'. Al suo
     * interno vengono anche fatti controlli per verificare la correttezza
     * della data.
     * @param $dn string La data che si vuole impostare
     * @throws Exception Se la data non rispetta il pattern.
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
     * Imposta il codice fiscale, se questo rispetta il pattern 'XXXXXX00X00X000X', in cui X è una lettera qualsiasi
     * e 0 un numero qualsiasi.
     * @param $cf string Il codice fiscale che si vuole impostare
     * @throws Exception Se il codice fiscale non rispetta il pattern.
     */
    public function setCodFis($cf) {
        $pattern="#^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$#";
        if(preg_match($pattern,$cf) != 1) {
            throw new Exception("Errore: formato codice fiscale non valido");
        }
        $this->codiceFiscale=$cf;
    }
    /**
     * Imposta il sesso, se è una lettera tra m e f (grande o piccola)
     * @param $s string Il sesso che si vuole impostare
     * @throws Exception Se il sesso non rispetta il pattern.
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
     * Imposta l'email, se rispetta un certo pattern
     * @param $e string L'email che si vuole impostare
     * @throws Exception Se l'email non rispetta il pattern.
     */
    public function setEmail($e) {
        $pattern = "#^[a-zA-Z0-9]{1,30}@[a-zA-Z]{1,10}\.[a-zA-Z]{1,5}$#";
        if (preg_match($pattern, $e) != 1) {
            throw new Exception("Errore: formato email non valido");
        }
        $this->email = strtolower($e);
    }
    /**
     * Imposta la password. Questa non può essere più corta di 8 caratteri, o averne più di 20.
     * @param $p string La password che si vuole impostare
     * @throws Exception Se la password non rispetta i vincoli di lunghezza
     */
    public function setPassword($p) {
        if(strlen($p) < 8 || strlen($p) > 20) {
            throw new Exception("Errore: formato password non valido");
        }
        $this->password = $p;
    }
    /**
     * Imposta l'id, se questo è un carattere numerico
     * @param $n int L'id che si vuole impostare
     * @throws Exception Se l'id non rispetta il pattern
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
     * Ritorna il nome
     * @return string Il nome
     */
    public function getNome()           { return $this->nome; }
    /**
     * Ritorna il cognome
     * @return string Il cognome
     */
    public function getCognome()        { return $this->cognome; }
    /**
     * Ritorna la data di nascita
     * @return string la data di nascita
     */
    public function getDataNascita()    { return $this->dataNascita; }
    /**
     * Ritorna il codice fiscale
     * @return string Il codice fiscale
     */
    public function getCodiceFiscale()  { return $this->codiceFiscale; }
    /**
     * Ritorna il sesso
     * @return string Il sesso
     */
    public function getSesso()          { return $this->sesso; }
    /**
     * Ritorna l'email
     * @return string L'email
     */
    public function getEmail()          { return $this->email; }
    /**
     * Ritorna la password
     * @return string La password
     */
    public function getPassword()       { return $this->password; }
    /**
     * Ritorna L'ID
     * @return int L'ID
     */
    public function getID()             { return $this->numID; }
    /**
     * Ritorna il codice di conferma
     * @return string Il codice di conferma
     */
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