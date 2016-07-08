<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');


class CLogin {
    
    private $task;
    
    public function __construct($a){
        $this->setTask($a);
    }
    public function getTask(){
        return $this->task;
    }
    public function setTask($a){
        $this->task=$a;
    }

    public function smista() {
        $a=$this->getTask();
        switch($a) {
            case 'login': {
                $cor=$this->processaLogin();
                return $cor;
                break;
            } 
            case 'logout': {
                $this->logout();
                break;
            }
            case 'controllaEsistenzaMailL': {
                return $this->controllaMail();
                break;
            } 
            case 'controllaEsistenzaMailR': {
                return $this->controllaMail();
                break;
            } 
            case 'conferma':{
                $this->conferma();
                break;
            }
            case 'reg': {
                $this->processaReg();
                header("location : index.php");
                break;
            }
            case 'controllaEsistenzaCodiceFiscale':{
               return $this->controllaCodiceFiscale();
               break;
            }
        }
    }



    public function processaLogin() {

        $sessione = new USession();

        if( !($sessione->getValore('idUtente'))) { // l'utente non è loggato
            $mail = $_REQUEST['email'];
            $pass = $_REQUEST['password'];
            $fute = new FUtente();
            $utente = $fute->caricaUtenteDaLogin($mail, $pass);
            if($utente!=false) { //è stato trovato un utente con mail e pass giuste
                $id = $utente->getID();
                if($id == 0) {
                    $sessione->impostaValore('idUtente',0);
                    $sessione->impostaValore('tipo','admin');
                }
                else {
                    $sessione->impostaValore('idUtente', $id);
                    $CUte = new CUtente();
                    $tipo = $CUte->controllaProfessionista($id);
                    $sessione->impostaValore('tipo', $tipo);
                }
                header('location: ../../index.php');
            }
            else                
            return $cor=false;
        }
    }
    public function processaReg(){
        $sessione=new USession();
        if(!$sessione->getValore('idutente')== -1){
            $nome=ucfirst($_POST['Nome']);
            $cognome=ucfirst($_POST['Cognome']);
            $data=$this->dataItaToISO($_POST['Data']);
            $codicefiscale=$_POST['CodiceFiscale'];
            $sesso=$_POST['Sesso'];
            $emailreg=$_POST['email'];
            $password=$_POST['Password'];
            $srpassword=$_POST['RPassword'];
            if($password != $srpassword) {
                throw new Exception("Le password non coincidono");
            }
            $codice=$this->GeneraCodice();   
            $Ute = new EUtente($nome,$cognome,$data,$codicefiscale,$sesso,$emailreg,$password,$codice);
            $FUte = new FUtente();
            $FUte->inserisciUtente($Ute);
            $FCli = new FCliente();
            $FCli->aggiungiCliente($FUte->getLastID());
            $mail=new UMail();
            $oggetto='Conferma Registrazione';
            $corpoMail = "Gentile $nome $cognome, per confermare l'iscrizione al sito cliccare sul seguente link:".
                         "http://localhost/appointment-manager/Control/Ajax/ALogin.php?task=conferma&code=$codice";
            $mail->inviaMail($emailreg, $nome, $oggetto, $corpoMail);
            
        }
            
            
    }

    public function conferma() {
        $code=$_REQUEST['code'];
        $sessione = new USession();
        $FUte=new FUtente();
        if($FUte->controllaEsistenza('codiceconferma', $code)){
            $Ute=$FUte->caricaUtenteDaConferma($code);
            $Ute->setCodiceConferma('0');
            if($FUte->aggiornaUtente($Ute)) {
                $CUte = new CUtente();
                $id = $Ute->getID();
                $tipo = $CUte->controllaProfessionista($id);
                $sessione->impostaValore('tipo',$tipo);
                $tipo = ucfirst($tipo);
                $sessione->impostaValore('idUtente',$id);
                header("location: ../../?controller=pagina$tipo&id=$id");
            }
        }
        else {
            header("location: ../../index.php"); // sarebbe meglio fare il redirect a una pagina d'errore
        }
    }
        
    public function controllaconferma(){
        $mail = strtolower(trim($_POST['email']));
        $FUte=new FUtente;
        $Ute=$FUte->caricaUtenteDaMail($mail);
        if($Ute->getCodiceConferma()=='0') 
        return true;
        else 
        return false;        }
        

    private function controllaMail() {
        $mail = trim($_POST['email']);
        $FUte = new FUtente();
        $a=$this->getTask();
        $esito = $FUte->controllaEsistenza('email',$mail);
        if($a==='controllaEsistenzaMailL'){return json_encode($esito);
        }
        elseif($a==='controllaEsistenzaMailR'){return json_encode(!$esito);}
        
    }
    private function ControllaCodiceFiscale(){
        $codicefiscale=$_POST['CodiceFiscale'];
        $FUte = new FUtente();
        $esito=$FUte->controllaEsistenza('codiceFiscale', $codicefiscale);
        return json_encode(!$esito);
    }
    private function logout() {
        $sessione = new USession();
        $sessione->fineSessione();
    }
    
    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }
    private function GeneraCodice(){
           $salt= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678';
           $len= strlen($salt);
           $length=8;
           $makepass   = '';
           mt_srand(10000000*(double)microtime());
           for ($i = 0; $i < $length; $i++) {
               $makepass .= $salt[mt_rand(0,$len - 1)];
           }
       	   return $makepass;
}

            

    
}

