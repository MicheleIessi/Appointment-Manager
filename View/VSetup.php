<?php


class VSetup extends View{

    public function __construct() {
        parent::__construct();
        $this->setTemplateDir('templates/templates');
        $this->setCompileDir('templates/templates_c');
        $this->setConfigDir('templates/configs');
        $this->setCacheDir('templates/cache');
    }

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

    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }


}