<?php

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
                //registrazione
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

    private function controllaMail() {
        $mail = trim($_REQUEST['email']);
        $FUte = new FUtente();
        $esito = $FUte->controllaEsistenza('email',$mail);

        return json_encode($esito);

    }
    private function logout() {
        $sessione = new USession();
        $sessione->fineSessione();
    }
}

