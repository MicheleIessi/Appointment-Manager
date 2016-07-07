<?php
class EUtente {
    protected $numID=null;  //solo lato db?
    protected $nome;
    protected $cognome;
    protected $dataNascita;
    protected $codiceFiscale;
    protected $sesso;
    protected $email;
    protected $password;
    protected $codiceConferma = 0;
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
    public function setCodiceConferma($cc){
        $this->codiceConferma=$cc;
    }
            
    public function setNome($n) {
        $pattern="#^[a-zA-Zàèéìòù \']{1,20}$#";
        if(preg_match($pattern,$n) != 1) {
            throw new Exception("Errore: formato nome non valido");
        }
        $this->nome = $n;
    }
    public function setCognome($c) {
        $pattern="#^[a-zA-Zàèéìòù\' ]{1,20}$#";
        if(preg_match($pattern,$c) != 1) {
            throw new Exception("Errore: formato cognome non valido");
        }
        $this->cognome = $c;
    }
    public function setDataNascita($dn) {
        
        $pattern="#^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern,$dn) != 1) {
            throw new Exception("Errore: formato data di nascita non valido1");
        }
        
        $dataNascita= explode("-", $dn);
        $anno= $dataNascita[0];
        $mese= $dataNascita[1];
        $giorno= (int)$dataNascita[2];
        
        // controllo sulla validità del giorno rispetto al mese
        
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
            
        /*
         * non c'è bisogno di fare i controlli sugli altri mesi, perchè per l'espressione
         * regolare nessun giorno può uscire dall'intervallo 01-31
        */
        $date = new DateTime($dn);
        $novecento = new DateTime('1900-01-01');
        $diciotto = new DateTime();
        $diciotto->modify('-18 years');
        if( $date < $novecento || $date > $diciotto )  {
            throw new Exception("Errore: formato data di nascita non valido5");
        }
        
        // Arrivati fin qui significa che tutti i controlli sono andati a buon fine, quindi:
        
        $this->dataNascita = $dn;
    }
    public function setCodFis($cf) {
        $pattern="#^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$#";
        if(preg_match($pattern,$cf) != 1) {
            throw new Exception("Errore: formato codice fiscale non valido");
        }
        $this->codiceFiscale=$cf;
    }
    public function setSesso($s) {
        $pattern="#^[mMfF]$#";
        if(preg_match($pattern,$s) != 1) {
            throw new Exception("Errore: formato sesso non valido");
        }
        $this->sesso=$s;
    }
    public function setEmail($e) {
        $pattern = "#^[a-zA-Z0-9]{1,30}@[a-zA-Z]{1,10}\.[a-zA-Z]{1,5}$#";
        if (preg_match($pattern, $e) != 1) {
            throw new Exception("Errore: formato email non valido");
        }
        $this->email = strtolower($e);
    }
    public function setPassword($p) {
        if(strlen($p) < 8 || strlen($p) > 20) {
            throw new Exception("Errore: formato password non valido");
        }
        $this->password = $p;
    }

    public function setID($n) {
        if(!is_null($n)) {
            $pattern = "#^[0-9]{1,6}#";
            if (preg_match($pattern, $n) != 1) {
                throw new Exception("Errore: ID non valido", 1);
            }
        }
        $this->numID = $n;
    }
    public function getNome()           { return $this->nome; }
    public function getCognome()        { return $this->cognome; }
    public function getDataNascita()    { return $this->dataNascita; }
    public function getCodiceFiscale()  { return $this->codiceFiscale; }
    public function getSesso()          { return $this->sesso; }
    public function getEmail()          { return $this->email; }
    public function getPassword()       { return $this->password; }
    public function getID()             { return $this->numID; }
    public function getCodiceConferma() {
        if($this->codiceConferma == 0) {
            return "0";
        }
        else
            return $this->codiceConferma;
    }
    // Metodo di utilità per il lato Foundation
    public function getArrayAttributi() {
        return array($this->numID,$this->nome,$this->cognome,$this->dataNascita,
            $this->codiceFiscale,$this->sesso,$this->email,$this->password,$this->codiceConferma);
    }
}