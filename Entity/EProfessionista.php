<?php

/**
 * Class EProfessionista
 */
class EProfessionista extends EUtente {

    private $serviziOfferti = array();
    private $settore;
    private $orariLavorativi = array();


    public function __construct($n, $c, $dn, $cf, $s, $e, $p, $cc, $id, $so, $set, $or) {
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p, $cc, $id);
        $this->setServiziOfferti($so);
        $this->setSettore($set);
        $this->setOrariLavorativi($or);
    }
    
    public function setServiziOfferti($so) {
        $this->serviziOfferti = array();
        foreach ($so as $servizio) {
            array_push($this->serviziOfferti, $servizio);
        }
    }
    
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
     * @return array EServizio
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

    public function rimuoviServizio($so) {
        if(($key = array_search($so, $this->serviziOfferti)) !== false) {
            unset($this->serviziOfferti[$key]);
            $this->serviziOfferti = array_values($this->serviziOfferti);
        }
        else {
            throw new Exception ("Servizio non presente");
        }
    }

    public function getArrayAttributi() {
        return array($this->numID,$this->settore,$this->orariLavorativi['lun'],$this->orariLavorativi['mar'],
                     $this->orariLavorativi['mer'],$this->orariLavorativi['gio'],$this->orariLavorativi['ven'],
                     $this->orariLavorativi['sab'],$this->orariLavorativi['dom']);
    }

    public function getUtenteDaProfessionista() {
        return new EUtente($this->getNome(),$this->getCognome(),$this->getDataNascita(),
                           $this->getCodiceFiscale(),$this->getSesso(),$this->getEmail(),
                           $this->getPassword(),$this->getID());
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