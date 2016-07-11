<?php

/**
 * VSetup si occupa di gestire la visualizzazione della pagina del setup.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VSetup extends View {

    public function __construct() {
        parent::__construct();
        $this->setTemplateDir('templates/templates');
        $this->setCompileDir('templates/templates_c');
        $this->setConfigDir('templates/configs');
        $this->setCacheDir('templates/cache');
    }

    /** La funzione getDatiAdmin si occupa di raccogliere i dati dalla form del setup relativa ai dati anagrafici
     * dell'amministratore. Prende i dati che servono dalla variabile superglobale $_REQUEST e controlla se tutti i
     * dati sono instanziati in modo corretto. Viene chiamata dal controller CSetup al momento del setup.
     * @return array | bool Un array contenente tutti i dati anagrafici dell'amministratore, o false se ci sono stati errori.
     */
    public function getDatiAdmin() {

        $dati = array();

        $boolNomeAdmin      = isset($_REQUEST['nomeAdmin']);
        $boolCognomeAdmin   = isset($_REQUEST['cognomeAdmin']);
        $boolNascitaAdmin   = isset($_REQUEST['dataNascitaAdmin']);
        $boolCFAdmin        = isset($_REQUEST['codiceFiscaleAdmin']);
        $boolSessoAdmin     = isset($_REQUEST['sessoAdmin']);
        $boolEmailAdmin     = isset($_REQUEST['emailAdmin']);
        $boolPassAdmin1     = isset($_REQUEST['passwordAdmin1']);
        $boolPassAdmin2     = isset($_REQUEST['passwordAdmin2']);

        if($boolNomeAdmin && $boolCognomeAdmin && $boolNascitaAdmin && $boolCFAdmin &&
            $boolSessoAdmin && $boolEmailAdmin && $boolPassAdmin1 && $boolPassAdmin2) {

            $dati['nomeAdmin']          = $_REQUEST['nomeAdmin'];
            $dati['cognomeAdmin']       = $_REQUEST['cognomeAdmin'];
            $dati['dataNascitaAdmin']   = $this->dataItaToISO($_REQUEST['dataNascitaAdmin']);
            $dati['codiceFiscaleAdmin'] = $_REQUEST['codiceFiscaleAdmin'];
            $dati['sessoAdmin']         = $_REQUEST['sessoAdmin'];
            $dati['emailAdmin']         = $_REQUEST['emailAdmin'];
            $dati['passwordAdmin1']     = $_REQUEST['passwordAdmin1'];
            $dati['passwordAdmin2']     = $_REQUEST['passwordAdmin2'];
        }
        else
            $dati = false;

        return $dati;
    }

    /** La funzione getDatiDB si occupa di raccogliere i dati dalla form del setup relativa ai dati del database.
     * Prende i dati che servono dalla variabile superglobale $_REQUEST e controlla se tutti i dati sono stati
     * instanziati in modo corretto. Viene chiamata dal controller CSetup al momento del setup.
     * @return array | bool Un array contenente tutti i dati relativi al database, o false se ci sono stati errori.
     */
    public function getDatiDB() {

        $dati = array();
        $boolDbms           = isset($_REQUEST['dbms']);
        $boolDBUser         = isset($_REQUEST['dbuser']);
        $boolDBPass         = isset($_REQUEST['dbpass']);
        $boolDBName         = isset($_REQUEST['dbname']);
        $boolDBHost         = isset($_REQUEST['dbhost']);

        if($boolDbms && $boolDBUser && $boolDBPass && $boolDBName && $boolDBHost) {

            $dati['dbms']               = $_REQUEST['dbms'];
            $dati['dbuser']             = $_REQUEST['dbuser'];
            $dati['dbpass']             = $_REQUEST['dbpass'];
            $dati['dbname']             = $_REQUEST['dbname'];
            $dati['dbhost']             = $_REQUEST['dbhost'];
        }
        else
            $dati = false;

        return $dati;
    }

    /** La funzione getDatiMail si occupa di raccogliere i dati dalla form del setup relativa ai dati della email che
     * verrà usata dall'applicazione. Prende i dati che servono dalla variabile superglobale $_REQUEST e controlla se
     * tutti i dati sono stati instanziati in modo corretto. Viene chiamata dal controller CSetup al momento del setup.
     * @return array | bool Un array contenente tutti i dati relativi alla email, o false se ci sono stati errori.
     */
    public function getDatiMail() {

        $dati = array();
        $boolSMTPHost       = isset($_REQUEST['smtphost']);
        $boolSMTPPort       = isset($_REQUEST['smtpport']);
        $boolSMTPUser       = isset($_REQUEST['smtpuser']);
        $boolSMTPPass       = isset($_REQUEST['smtppass']);

        if($boolSMTPHost && $boolSMTPPort && $boolSMTPUser && $boolSMTPPass) {

            $dati['smtphost']           = $_REQUEST['smtphost'];
            $dati['smtpport']           = $_REQUEST['smtpport'];
            $dati['smtpuser']           = $_REQUEST['smtpuser'];
            $dati['smtppass']           = $_REQUEST['smtppass'];
        }
        else
            $dati = false;

        return $dati;
    }

    /** È una funzione di supporto che si occupa di trasformare una data dal formato gg/mm/aaaa al formato aaaa-mm-gg.
     * @param $data string La data originale in formato gg/mm/aaaa.
     * @return string La data riformattata nel formato ISO aaaa-mm-gg.
     */
    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }


}