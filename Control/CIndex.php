<?php
/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 24/05/2016
 * Time: 16:51
 */

/**
 * 1. controllare se l'utente ha già effettuato il login (sessioni).
 * 2. se ha già effettuato il login, mandare la home con la possibilità di scegliere le opzioni utente (prenotazione, profilo...)
 * 3. altrimenti far vedere una pagina di presentazione con i pulsanti login/registrazione e senza le opzioni utente
 */


class CIndex {

    public function impostaPagina() {
        $log = -1;
        $sessione = new USession();
        $log = $sessione->getValore('tipoUtente');
        $log = $sessione->getValore('idUtente');
        if($log===false) {
            $log=1;    //a questo punto del programma in questo commit, bisogna fare controlli per il login
        }
        $VIndex = new VIndex();
        $content = $this->smista($log);
        $VIndex->setContent($content);
        if($log==-1)//-1=non loggato
            $VIndex->impostaPaginaOspite();
        else if($log==0)//0=utente
            /* qualcosa */;
        else if($log==1)//professionista/admin?
            $VIndex->impostaPaginaRegistrato();
        $VIndex->mostraPagina();
    }

    public function smista($log) {
        $view = new VIndex();
        $sessione = new USession();
        switch($view->getController()) {
            case 'registrazione':
                $CReg = new CRegistrazione();
                return $CReg->smista();
            case 'login':
                $CLog = new CLogin();
                return $CLog->smista();
            case 'lista':
                if($log > 0) {
                    $sessione->impostaValore('tipo','cliente'); //solo per provare

                    $cal = new CCalendar();
                    return $cal->smista();
                }
            else return $view->fetch('forbidden.tpl');
            case 'calendario':
                if($log > 0 && isset($_REQUEST['idp'])) { //gestire l'errore se non c'è idp?
                    $cal = new CCalendar();
                    $idp=$_REQUEST['idp'];
                    setcookie('lastCalendar',$idp);
                    $sessione->impostaValore('tipo','cliente'); //solo per provare
                    $fpro = new FProfessionista();
                    $view->impostaDivProfessionisti($fpro->caricaProfessionisti());
                    return $cal->smista();
                }
                else return $view->fetch('forbidden.tpl');
            default:
                return $view->fetch('home_default_content.tpl');
        }
    }
}