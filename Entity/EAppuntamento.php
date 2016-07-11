<?php

/**
* EAppuntamento e' una delle classi del package Entity
*
* EAppuntamento e' la classe invocata ogni volta che viene creato un appuntamento
* tra un professionista ed un utente
*  
*
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
*/

class EAppuntamento {

    // Attributi
    private $IDAppuntamento;
    private $data;          // Stringa formattata secondo il pattern yyyy-mm-dd
    private $orarioInizio;  // Stringa formattata seconda il pattern hh:mm:ss
    private $visita;        // E' un EServizio
    private $IDCliente;
    private $IDProfessionista;

    public function __construct($IDP,$IDC,$d,$o,$v,$IDApp='DEFAULT') {
        $this->setIDProfessionista($IDP);
        $this->setIDCliente($IDC);
        $this->setData($d);
        $this->setOrarioInizio($o);
        $this->setVisita($v);
        $this->setIDAppuntamento($IDApp);
    }

    /**
     * Imposta l'id dell'appuntamento
     * @param $IDApp int L'id da impostare
     */
    public function setIDAppuntamento($IDApp) {
        $this->IDAppuntamento = $IDApp;
    }

    /**
     * Effettua un controllo sulla validita della data prima del settaggio
     * @param  $d
     * @throws PDOException
     */
    public function setData($d)    {
        $pattern = "#^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])$#";
        if(preg_match($pattern, $d) != 1) {
            throw new PDOException("Data non valida", 1);
        }
        $this->data = $d;
    }

    /**
     * Effettua un controllo sulla validita dell'orario di inizio
     * @param string $o
     * @throws PDOException
     */
    public function setOrarioInizio($o)    {
        $pattern = "#^(2[0-3]|[01][0-9]|[1-9]):([0-5][0-9]):([0-5][0-9])#";
        if(preg_match($pattern, $o) != 1) {
            throw new PDOException("Orario non valido: inserire un orario tra 00:00:00 e 23:59:59");
        }
        $this->orarioInizio = $o;
    }

    /**
     * setVisita prende come parametro un istanza di EServizio per controllare
     * che essa risulti essere un servizio che il professionista effettivamente
     * puo concedere
     *
     * @param EServizio $v
     * @throws PDOException
     */
    public function setVisita($v)    {
        if(!(is_a($v, "EServizio")))    {
            throw new PDOException("Variabile non valida: deve essere un'istanza di EServizio, variabile di tipo ".gettype($v)." passata.");
        }
        else {
            $this->visita=$v;   // Composizione
        }
    }

    /**
     * Imposta l'id del cliente.
     * @param $IDC int L'id dell'utente.
     * @throws PDOException
     */
    public function setIDCliente($IDC) {
        $pattern = '#^([0-9]){1,6}$#';
        if(preg_match($pattern, $IDC) != 1) {
            throw new PDOException("ID Cliente non valido.");
        }
        $this->IDCliente = $IDC;
    }

    /**
     * Imposta l'id del professionista.
     * @param $IDP int L'id del professionista.
     */
    public function setIDProfessionista($IDP) {
        $pattern = "#^[0-9]{1,6}$#";
        if(preg_match($pattern, $IDP) != 1) {
            throw new PDOException("ID Professionista non valido.");
        }
        $this->IDProfessionista=$IDP;
    }
    /**
     * Ritorna l'id dell'appuntamento.
     * @return int L'id dell'appuntamento
     */
    public function getIDAppuntamento() { return $this->IDAppuntamento; }

    /**
     * Ritorna la data.
     * @return mixed La data.
     */
    public function getData() { return $this->data; }

    /**
     * Ritorna l'orario.
     * @return mixed L'orario.
     */
    public function getOrario() { return $this->orarioInizio; }
    /**
     * Ritorna il servizio.
     * @return EServizio Il servizio.
     */
    public function getVisita() { return $this->visita; }

    /**
     * Ritorna l'ID del cliente.
     * @return int L'ID del cliente.
     */
    public function getIDCliente() { return $this->IDCliente; }

    /**
     * Ritorna l'ID del professionista.
     * @return int L'ID del professionista.
     */
    public function getIDProfessionista() { return $this->IDProfessionista; }

    /**
     * Metodo di utilità per il lato Foundation
     * Internamente al metodo e' presente un costrutto if else poiche
     * nel caso in cui l'id dell'appuntamento sia uguale a "0"
     * l'array degli attributi dovrebbe ritornare un valore in meno che e' proprio l'ID
     * dell'appuntamento ,poiche l'ID dell'appuntamento viene generato dopo l'inserimento
     * nel db
     *
     * @return array
     *
     */
    public function getArrayAttributi() {
        if($this->IDAppuntamento !==0 )
            return array($this->IDAppuntamento,$this->IDProfessionista,$this->IDCliente,$this->data,$this->orarioInizio,$this->visita);
        else
            return array($this->IDProfessionista,$this->IDCliente,$this->data,$this->orarioInizio,$this->visita);

    }
}