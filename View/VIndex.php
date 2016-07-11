<?php
/**
 * VIndex è la classe principale relativa alla visualizzazione. Si occupa di mostrare i dati in tre parti: main_button,
 * main_content e side_content.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VIndex extends View {
    /**
     * @var string Il contenuto principale
     */
    private $main_content = "";
    /**
     * @var array I bottoni presenti a capo di una pagina
     */
    private $main_button=array();
    /**
     * @var string Il contenuto marginale della pagina
     */
    private $side_content = '';

    /** La funzione setContent imposta il contenuto principale della pagina.
     * @param $content resource Il contenuto della pagina. È un template.
     */
    public function setContent($content) {
        $this->main_content = $content;
    }

    /**
     * La funzione mostraPagina imposta le variabili Smarty del template di default, il titolo, il banner e i bottoni
     * e mostra quindi il template opportunamente popolato.
     */
    public function mostraPagina() {
        $this->loadButtons();
        $this->assign('banner',$this->getBanner());
        $this->assign('main_content',$this->main_content);
        $this->assign('mainButtons',$this->main_button);
        $this->assign('right_content',$this->side_content);
        $this->display('home_default.tpl');
    }

    /** La funzione setSideContent imposta il contenuto marginale della pagina.
     * @param $content resource Il contenuto marginale della pagina. È un template.
     */
    public function setSideContent($content) {
        $this->side_content=$content;
    }

    /**
     * La funzione aggiungiTastiLogin aggiunge ai tasti di navigazione i link relativi a login e registrazione.
     */
    public function aggiungiTastiLogin() {
        $loginReg = array();
        $loginReg[]=array('testo'=>'Login','link'=>'#loginmodal');
        $loginReg[]=array('testo'=>'Registrati','link'=>'#registrazionemodal');
        $this->main_button=array_merge($this->main_button,$loginReg);
    }

    /**
     * La funzione impostaPaginaOspite imposta la pagina per gli utenti non autenticati
     */
    public function impostaPaginaOspite() {
        $this->aggiungiTastiLogin();
        $this->assign('title','Appointment Manager');
        $this->assign('main_content',$this->main_content);
        $this->assign('right_content',$this->side_content);
    }

    /**
     * La funzione aggiungiTastiLoggato aggiunge ai tasti di navigazione i link relativi al profilo e al logout.
     */
    public function aggiungiTastiLoggato() {
        $logBut = array();
        $sessione = new USession();
        $tipo = $sessione->getValore('tipo');
        $id = $sessione->getValore('idUtente');
        if($tipo =='cliente')
            $logBut[]=array('testo'=>'Profilo','link'=>'?controller=paginaCliente&id='.$id);
        else if($tipo == 'professionista')
            $logBut[]=array('testo'=>'Profilo','link'=>'?controller=paginaProfessionista&id='.$id);
        $logBut[]=array('testo'=>'Logout','link'=>'#logout');
        $this->main_button=array_merge($this->main_button,$logBut);
    }

    /**
     * La funzione impostaPaginaAdmin imposta la pagina per l'amministratore.
     */
    public function impostaPaginaAdmin() {
        $this->aggiungiTastiLoggato();
        $this->assign('title','Amministrazione sito');
        $this->assign('main_content',$this->main_content);
        $this->assign('right_content',$this->side_content);
    }

    /**
     * La funzione impostaPaginaRegistrato imposta la pagina per l'utente autenticato.
     */
    public function impostaPaginaRegistrato() {
        $this->aggiungiTastiLoggato();
        $this->assign('title','Appointment Manager');
        $this->assign('main_content',$this->main_content);
        $this->assign('right_content',$this->side_content);
    }

    /** La funzione getBanner restituisce il template relativo al banner del sito.
     * @return string Il template relativo al banner del sito
     */
    public function getBanner() {
        return $this->fetch('banner.tpl');
    }

    /**
     * La funzione loadButtons carica i bottoni statici ('Chi Siamo' e 'Credits') dal file di configurazione.
     * L'aggiunta manuale di nuovi bottoni statici al file di configurazione non compromette il funzionamento.
     */
    public function loadButtons() {
        global $config;
        $buttons = array();
        foreach($config['home'] as $button) {
            $buttons[]=$button;
        }
        $this->main_button = array_merge($this->main_button,$buttons);

    }
}