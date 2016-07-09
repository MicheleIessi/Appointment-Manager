<?php
/**
* EProfessionista e' la classe principale del package Entity
*
* EProfessionista e' la classe invocata ogni volta che bisogna creare degli
* oggetti EProfessionista 
*
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
* 
*/
class EProfessionista extends EUtente {
    
    //Attributi
    private $serviziOfferti = array();
    private $settore;
    private $orariLavorativi = array();
    
    //Costruttore
    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $cc, $id, $so, $set, $or) {
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $cc, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrariLavorativi($or);
    }
    
    /**
     * Viene settato l'array dei servizi offerti dal prfessionista
     * @param array $so
     */
    
    public function setServiziOfferti($so) {
        $this->serviziOfferti = array();
        foreach ($so as $servizio) {
            array_push($this->serviziOfferti, $servizio);
        }
    }
    /**
     * Vine settato il settore di competenza del professionista
     * @param $set
     */
    
    public function setSettore($set) {
        $this->settore = $set;
    }

    /**
     * setOrariLavorativi fa in modo che un array associativo del tipo 'lun'=>'aa:bb:cc-xx:yy:zz','mar'=>...
     * venga inserito nel professionista per determinare gli orari in cui egli accetta appuntamenti
     * @param $or
     */
    public function setOrariLavorativi($or) {
        if($this->esaminaOrariLavorativi($or)) {
            $this->orariLavorativi = $or;
        }
    }
    /**
     * 
     * La funzione modificaGiornoLavorativo accetta un parametro giorno e orario
     * cerca il giorno dato e ne aggiorna l'orario
     * @param type $giorno
     * @param type $orario
     */

    public function modificaGiornoLavorativo($giorno,$orario) {
        $chiaviRichieste = array('lun','mar','mer','gio','ven','sab','dom');
        if(array_search($giorno,$chiaviRichieste) != false) {

            $pattern = "#^(([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])-([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]),?)+$#";
            if(preg_match($pattern,$orario) == 1) {
                $this->orariLavorativi[$giorno] = $orario;
            }
            else
                echo "Formato orario non valido.<br>";
        }
        else
            echo "Giorno non valido.<br>";
    }
    /**
     * @return type
     */
    public function getServiziOfferti()     {
        return $this->serviziOfferti;
    }
    
    public function getSettore()    {
        return $this->settore;
    }
    
    public function getOrariLavorativi()  {
        return $this->orariLavorativi;
    }

    public function aggiungiServizio($so) {
        array_push($this->serviziOfferti, $so);
    }
    /**
     * La funzione rimuoviServizio riceve il nome di un servizio svolto dal 
     * professionista effettua un controllo sull'array dei servizi offerti dallo 
     * stesso , nel caso in cui ci sia match viene eliminato quel servizio
     * @param type $so
     * @throws Exception
     */
    public function rimuoviServizio($so) {
        if(($key = array_search($so, $this->serviziOfferti)) !== false) {
            unset($this->serviziOfferti[$key]);
            $this->serviziOfferti = array_values($this->serviziOfferti);
        }
        else {
            throw new Exception ("Servizio non presente");
        }
    }
    /**
     * Metodo di utilita' per il lato foundation
     * E' lo stesso metodo utilizzato per EUtente solo e' adattato
     * al caso professionista
     * @return array
     */

    public function getArrayAttributi() {
        return array($this->numID,$this->settore,$this->orariLavorativi['lun'],$this->orariLavorativi['mar'],
                     $this->orariLavorativi['mer'],$this->orariLavorativi['gio'],$this->orariLavorativi['ven'],
                     $this->orariLavorativi['sab'],$this->orariLavorativi['dom']);
    }

    public function getUtenteDaProfessionista() {
        return new EUtente($this->getNome(),$this->getCognome(),$this->getDataNascita(),
                           $this->getCodiceFiscale(),$this->getSesso(),$this->getEmail(),
                           $this->getPassword(),$this->getCodiceConferma(),$this->getID());
    }

    /**Gli orari lavorativi devono essere rappresentati da un array associativo del tipo 'lun'=>'aa:bb:cc-xx:yy:zz','mar'=>...
     * @param $orari
     * @return bool
     */
    public function esaminaOrariLavorativi($orari) {

        $esito = false;
        if(is_array($orari)) {

            $chiaviRichieste = array('lun','mar','mer','gio','ven','sab','dom');
            if(count(array_intersect_key(array_flip($chiaviRichieste),$orari)) === count($chiaviRichieste)) {//vuol dire che ci sono tutti i giorni

                $pattern = "#^(([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])-([2][0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]),?)+$#";
                $i = 0;
                foreach($orari as $giorno) {
                    if(preg_match($pattern,$giorno) != 1) {
                        echo "Formato orario non valido per il giorno $chiaviRichieste[$i]";
                        return false;
                    }
                    $i++;
                }
                $esito = true;
            }
            else
                echo "Mancano alcune chiavi nell'orario.<br>";
        }
        else
            echo "Il parametro passato non è un array di orari valido.";
        return $esito;
    }
}