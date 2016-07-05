<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/includes/autoload.inc.php');


class CLogin {

    public function smista($task) {

        switch($task) {
            case 'login': {
                $this->processaLogin();
                header('location: ../../index.php');
            } break;
            case 'logout': {
                $this->logout();
            } break;
            case 'controllaEsistenzaMail': {
                return $this->controllaMail();
            }
            case 'reg': {
                $this->processaReg();
                header('location:../../index.php');   
            }
            case 'controllaEsistenzaCodiceFiscale':{
               return $this->controllaCodiceFiscale(); 
            }
        }
    }



    public function processaLogin() {

        $sessione = new USession();

        if(!$sessione->getValore('idUtente') == -1) {
            $mail = $_REQUEST['email'];
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
            $nome=$_POST['Nome'];
            $cognome=$_POST['Cognome'];
            $data=$_POST['Data'];
            $codicefiscale=$_POST['CodiceFiscale'];
            $sesso=$_POST['Sesso'];
            $emailreg=$_POST['EmailReg'];
            $password=$_POST['Password'];
            $Ute=new EUtente($nome,$cognome,$data,$codicefiscale,$sesso,$emailreg,$password);
            $FUte=new FUtente();
        $FUte->inserisciUtente($Ute);}
            
            
    }
    

    private function controllaMail() {
        $mail = trim($_REQUEST['EmailReg']);
        $FUte = new FUtente();
        $esito = $FUte->controllaEsistenza('email',$mail);
        return json_encode(!$esito);

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
}

