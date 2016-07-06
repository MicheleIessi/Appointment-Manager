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


    public function impostaPagina()
    {
        if (!file_exists('includes/config.inc.php')) {
            $CSet = new CSetup();
            $CSet->smista();
        }
        else {
            require_once('includes/config.inc.php');
            $this->VIndex = new VIndex();
            $sessione = new USession();
            $log = $sessione->getValore('idUtente');
            //        $sessione->impostaValore('idUtente',15);
            //        $sessione->impostaValore('tipo','cliente');
            if ($log === false) {

                $log = -1;
            }

            $this->VIndex = new VIndex();
            $content = $this->smista($log);
            $this->VIndex->setContent($content);


            if ($log == -1)//-1=non loggato
                $this->VIndex->impostaPaginaOspite();
            else if ($log == 0)//0=admin
                /* qualcosa */
                ;
            else if ($log > 0)//professionista/utente
                $this->VIndex->impostaPaginaRegistrato();


            $this->VIndex->mostraPagina();
        }
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
                if($log >= 0) {
                    $cal = new CCalendar();
                    return $cal->smista();
                }
            else return $this->VIndex->fetch('forbidden.tpl');
            case 'calendario':
                if($log >= 0) {
                    $FPro = new FProfessionista();
                    $profDisponibili = $FPro->caricaProfessionisti();
                    $idDisponibili = array();
                    foreach($profDisponibili as $professionista) {
                        /* @var $professionista EProfessionista */
                        array_push($idDisponibili,$professionista->getID());
                    }
                    if (isset($_REQUEST['idp']) && is_numeric($_REQUEST['idp']) && array_search($_REQUEST['idp'],$idDisponibili)!==false) {
                        $idp = $_REQUEST['idp'];
                        $sessione->impostaValore('idCalendario',$idp);
                        $cal = new CCalendar();
                        if ($sessione->getValore('tipo') == 'professionista') {
                            if($sessione->getValore('idUtente') == $idp)
                                $this->VIndex->setSideContent($cal->getColonnaProfessionista());
                            else
                                $this->VIndex->setSideContent($cal->getColonnaInformazioni());
                        }
                        else if ($sessione->getValore('tipo') == 'cliente') {
                            $this->VIndex->setSideContent($cal->getServiziProf($idp));
                        }
                        return $cal->smista();
                    }
                    else
                        return $this->VIndex->fetch('professionistaNonTrovato.tpl');
                    }
                return $this->VIndex->fetch('forbidden.tpl');
            case 'paginaCliente':
                if($log > 0) {                
                    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $CPagU = new CUtente();
                    $idUtente = $_REQUEST['id'];
                    $sessione->impostaValore('paginaDaMostrare', 'cliente');
                    if($CPagU->controllaProfessionista($idUtente) == 'cliente') {
                        return $CPagU->smista($idUtente);
                    }
                    else {
                        return $this->VIndex->fetch('errore.tpl');
                    }
                    
                }
            }
            else
                return $this->VIndex->fetch('forbidden.tpl');
            case 'paginaProfessionista':
                if($log > 0) {                
                    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                        $CPagU = new CUtente();
                        $idProfessionista = $_REQUEST['id'];
                        $sessione->impostaValore('paginaDaMostrare', 'professionista');
                        if($CPagU->controllaProfessionista($idProfessionista) == 'professionista') {
                            return $CPagU->smista($idProfessionista);
                        }
                        else {
                            return $this->VIndex->fetch('errore.tpl');
                        }
                    }
               }
                else
                    return $this->VIndex->fetch('forbidden.tpl');

            case 'modificaUtente':
                $messaggio = $sessione->getValore('messaggioErrore');
                $this->VIndex->setData('messaggio', $messaggio);
                $sessione->cancellaValore('messaggioErrore');
                return $this->VIndex->fetch('modificaUtente.tpl');     // solo per provare, ancora da fare i controlli
            default:
                return $this->VIndex->fetch('home_default_content.tpl');
        }
    }
    
}
