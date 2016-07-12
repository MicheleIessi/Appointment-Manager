<?php
/**CIndex si occupa di gestire il carimento dei templates.
 *
 * @package  Control
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class CIndex {

    private $VIndex;

    /** Il metodo 'impostaPagina' si occupa del caricamento di un template nel main_content della 
     * pagina web da visualizzare. Questa azione viene svolta richiamando il metodo 'smista' (che in base 
     * al valore del 'controller' delega il compito alla classe Control più appropriata per l'azione richiesta),
     * il metodo 'setContent' della classe VIndex (che è il metodo che effettivamente assegna il template 
     * selezionato al main_content) e infine il metodo 'mostraPagina', sempre della classe VIndex (che è il 
     * mediante il quale il template selezionato viene mostrato a video).
     */
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

            if ($log === false) {
                $log = -1;
            }


            $this->VIndex = new VIndex();
            $content = $this->smista($log);
            $this->VIndex->setContent($content);


            if ($log == -1)//-1=non loggato
                $this->VIndex->impostaPaginaOspite();
            else if ($log == 0)//0=admin
                $this->VIndex->impostaPaginaAdmin();
            else if ($log > 0)//professionista/utente
                $this->VIndex->impostaPaginaRegistrato();

            $this->VIndex->mostraPagina();
        }
    }
    
    /**Il metodo 'smista' effettua un controllo sul valore della variabile 'controller' della classe
     * VIndex; in base al valore di questa variabile si occupa di richiamare i metodi della classe 
     * Control più appropriata per lo svolgimento dell'azione richiesta. Questi metodi ritorneranno 
     * dei templates che verranno quindi caricati nel main_content dal metodo 'impostaPagina'.
     * 
     * @param int $log Valore intero che indica se un utente è loggato o meno; questo valore corrisponde
     * all'ID dell'utente: un valore >=0 indica quindi che l'utente è loggato (0 per amministratore).
     * Il valore -1 indica che l'utente non è autenticato.
     * @return resource
     */
    public function smista($log) {
        $sessione = new USession();
        if($log == 0) {
            $VAdm = new VAdmin();
            $messaggio = $sessione->getValore('messaggioErrore');
            $VAdm->setData('messaggio', $messaggio);
            $sessione->cancellaValore('messaggioErrore');
            return $VAdm->impostaTemplate();
        }
        else {
            switch($this->VIndex->getController()) {
                case 'reg':
                    $con = $_REQUEST['controller'];
                    $this->VIndex->unsetController();
                    $CLog = new CLogin($con);
                    return $CLog->smista();
                    break;
                case 'logout':
                    $con = $_REQUEST['controller'];
                    $this->VIndex->unsetController();
                    $CLog = new CLogin($con);
                    $CLog->smista();
                    break;
                case 'login':
                    $con=$_REQUEST['controller'];
                    $this->VIndex->unsetController();
                    $CLog = new CLogin($con);
                    if($CLog->controllaconferma()){
                      if(!$CLog->smista())
                        return $this->VIndex->fetch('passworderrata.tpl');
                    }
                    else
                        return $this->VIndex->fetch('conferma.tpl');
                    break;
                case 'lista':
                    if($log >= 0) {
                            $cal = new CCalendar();
                            return $cal->smista('lista');
                        }
                    else
                        return $this->VIndex->fetch('forbidden.tpl');
                case 'calendario':
                    if ($log >= 0) {
                        $FPro = new FProfessionista();
                        $profDisponibili = $FPro->caricaProfessionisti();
                        $idDisponibili = array();
                        foreach ($profDisponibili as $professionista) {
                            /* @var $professionista EProfessionista */
                            array_push($idDisponibili, $professionista->getID());
                        }
                        if (isset($_REQUEST['idp']) && is_numeric($_REQUEST['idp']) && array_search($_REQUEST['idp'], $idDisponibili) !== false) {
                            $idp = $_REQUEST['idp'];
                            $sessione->impostaValore('idCalendario', $idp);
                            $cal = new CCalendar();
                            if ($sessione->getValore('tipo') == 'professionista') {
                                if ($sessione->getValore('idUtente') == $idp)
                                    $this->VIndex->setSideContent($cal->getColonnaProfessionista());
                                else
                                    $this->VIndex->setSideContent($cal->getColonnaInformazioni());
                            } else if ($sessione->getValore('tipo') == 'cliente') {
                                $this->VIndex->setSideContent($cal->getServiziProf($idp));
                            }
                            return $cal->impostaPagina();
                        } else
                            return $this->VIndex->fetch('professionistaNonTrovato.tpl');
                    }
                    return $this->VIndex->fetch('forbidden.tpl');
                case 'paginaCliente':
                    if ($log > 0) {
                        if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                            $CPagU = new CUtente();
                            $idUtente = $_REQUEST['id'];
                            $sessione->impostaValore('paginaDaMostrare', 'cliente');
                            if ($CPagU->controllaProfessionista($idUtente) == 'cliente') {
                                return $CPagU->smista($idUtente);
                            } else {
                                return $this->VIndex->fetch('errore.tpl');
                            }
                        }
                    } else
                        return $this->VIndex->fetch('forbidden.tpl');
                case 'paginaProfessionista': {
                    if ($log > 0) {
                        if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                            $CPagU = new CUtente();
                            $idProfessionista = $_REQUEST['id'];
                            $sessione->impostaValore('paginaDaMostrare', 'professionista');
                            if ($CPagU->controllaProfessionista($idProfessionista) == 'professionista') {
                                return $CPagU->smista($idProfessionista);
                            } else {
                                return $this->VIndex->fetch('errore.tpl');
                            }
                        }
                    } else
                        return $this->VIndex->fetch('forbidden.tpl');
                }
                case 'modificaUtente': {
                    $messaggio = $sessione->getValore('messaggioErrore');
                    $this->VIndex->setData('messaggio', $messaggio);
                    $sessione->cancellaValore('messaggioErrore');
                    return $this->VIndex->fetch('modificaUtente.tpl');
                }
                case 'info': {
                    $CInfo = new CInfo();
                    return $CInfo->smista();
                }
                default: {
                    $nome = "ospite";
                    if($log > 0) {
                        $FUte = new FUtente();
                        $ute = $FUte->caricaUtenteDaDb($log);
                        $nome = $ute->getNome()." ".$ute->getCognome();
                    }
                    $this->VIndex->setData('nome',$nome);
                    return $this->VIndex->fetch('home_default_content.tpl');
                }
            }
        }
    }
}
