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
    /**
     * @var VIndex
     */
    private $VIndex;

    public function impostaPagina() {
        $this->VIndex = new VIndex();
        $log = -1;
        $sessione = new USession();
        $log = $sessione->getValore('idUtente');
        $sessione->impostaValore('tipo','cliente');
        if($log===false) {
            $log=1;    //a questo punto del programma in questo commit, bisogna fare controlli per il login
        }
        $this->VIndex = new VIndex();
        $content = $this->smista($log);
        $this->VIndex->setContent($content);


        if($log==-1)//-1=non loggato
            $this->VIndex->impostaPaginaOspite();
        else if($log==0)//0=utente
            /* qualcosa */;
        else if($log==1)//professionista/admin?
            $this->VIndex->impostaPaginaRegistrato();
        $this->VIndex->mostraPagina();
    }

    public function smista($log) {
        $sessione = new USession();
        switch($this->VIndex->getController()) {
            case 'registrazione':
                $CReg = new CRegistrazione();
                return $CReg->smista();
                
            case 'login':
                $CLog = new CLogin();
                return $CLog->smista();
            case 'lista':
                if($log > 0) {
                    $sessione->impostaValore('tipo','professionista'); //solo per provare

                    $cal = new CCalendar();
                    return $cal->smista();
                }
            else return $this->VIndex->fetch('forbidden.tpl');
            case 'calendario':
                if($sessione->getValore('tipo') == 'cliente') {
                    if($log > 0 && isset($_REQUEST['idp'])) { //gestire l'errore se non c'è idp?
                        $idp = $_REQUEST['idp'];
                        setcookie('lastCalendar', $idp);
                        $cal = new CCalendar();
                        $this->VIndex->setSideContent($cal->getServiziProf($idp));
                        return $cal->smista();
                    }
                }
                else if($sessione->getValore('tipo') == 'professionista') {
                    ;//
                }
                return $this->VIndex->fetch('forbidden.tpl');
                
            case 'paginaCliente':
                $idUtente = $_REQUEST['id'];
                $CPagU = new CUtente();
                $sessione->impostaValore('tipo','cliente'); //solo per provare
                return $CPagU->smista($idUtente);
                
            case 'paginaProfessionista':
                $idProfessionista = $_REQUEST['id'];
                $CPagP = new CUtente();
                $sessione->impostaValore('tipo', 'professionista');
                return $CPagP->smista($idProfessionista);
                
            default:
                return $this->VIndex->fetch('home_default_content.tpl');
        }
    }
}