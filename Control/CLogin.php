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
                $this->processaLogin();
                header('location: ../../index.php');
            } break;
            case 'logout': {
                $this->logout();
            } break;
            case 'controllaEsistenzaMailL': {
                return $this->controllaMail();
            } break;
            case 'controllaEsistenzaMailR': {
                return $this->controllaMail();
            } break;
            case 'controllaconferma':{
                return $this->controllaconferma();
            }    
            case 'reg': {
                $this->processaReg();
                header('location:../../index.php');   
            }break;
            case 'controllaEsistenzaCodiceFiscale':{
               return $this->controllaCodiceFiscale(); 
            }break;
        }
    }



    public function processaLogin() {

        $sessione = new USession();

        if( !$sessione->getValore('idUtente') == -1) {
            $mail = $_POST['email'];
            $pass = $_POST['pass'];
            $fute = new FUtente();
            $utente = $fute->caricaUtenteDaLogin($mail, $pass);
            if($utente!=false) { //è stato trovato un utente con mail e pass giuste
                $id = $utente->getID();
                $sessione->impostaValore('idUtente',$id);
                $CUte = new CUtente();
                $tipo = $CUte->controllaProfessionista($id);
                $sessione->impostaValore('tipo',$tipo);
            }
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
            $codice=$this->GeneraCodice();   
            $Ute=new EUtente($nome,$cognome,$data,$codicefiscale,$sesso,$emailreg,$password,$codice);
            $FUte=new FUtente();
            $FUte->inserisciUtente($Ute);
            $mail=new UMail();
            $oggetto='Conferma Registrazione';
            $corpoMail='http://localhost/appointment-manager/Control/Ajax/AConfirm.php?confirm='.$codice;
            $mail->inviaMail($emailreg, $nome, $oggetto, $corpoMail);
        }
            
            
    }
    public function controllaconferma(){
        $mail = trim($_POST['email']);
        $a=$this->getTask();
        $FUte=new FUtente;
        $esito=$FUte->controllaEsistenza('email', $mail);
        if($esito){
            $Ute=$FUte->caricaUtenteDaMail($mail);
            if($Ute->getCodiceconferma()!=0)
            {return json_encode(false);}
            else
            {return json_encode(true);}          
         
        }
        else{return json_encode($esito);}
           
    }    

    private function controllaMail() {
        $mail = trim($_POST['email']);
        $FUte = new FUtente();
        $a=$this->getTask();
        $esito = $FUte->controllaEsistenza('email',$mail);
        if($a==='controllaEsistenzaMailL'){return json_encode($esito);
        }
        elseif($this->getTask()==='controllaEsistenzaMailR'){return json_encode(!$esito);}
        
    }
    private function ControllaCodiceFiscale(){
        $codicefiscale=($_REQUEST['CodiceFiscale']);
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

