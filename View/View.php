<?php

require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/smarty/Smarty.class.php');

/**
 * View è la classe principale della parte relativa alla visualizzazione di pagine tramite templates. È un'estensione
 * di Smarty.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class View extends Smarty {
    
    public function __construct() {
        parent::__construct();
        global $config;
        $this->setTemplateDir($config['smarty']['template_dir']);       // directory dei template
        $this->setCompileDir($config['smarty']['compile_dir']);         // directory per compilare
        $this->setConfigDir($config['smarty']['config_dir']);           // directory dei configs
        $this->setCacheDir($config['smarty']['cache_dir']);             // directory della cache
        $this->caching = false;
    }

    /** La funzione setTemplate chiama la funzione display di Smarty per settare un template
     * @param $template resource Il template da mostrare
     */
    public function setTemplate($template) {
        $this->display($template);
    }

    /** La funzione getController ritorna il valore di $_REQUEST['controller'], se c'è.
     * @return bool | string Il valore di $_REQUEST['controller'] se presente, false se non c'è.
     */
    public function getController() {
        if(isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        return false;
    }

    /** La funzione getTask ritorna il valore di $_REQUEST['task'], se c'è.
     * @return bool | string Il valore di $_REQUEST['task'] se presente, false se non c'è.
     */
    public function getTask() {
        if(isset($_REQUEST['task']))
            return $_REQUEST['task'];
        return false;
    }

    /**
     * La funzione unsetController cancella $_REQUEST['controller'], se presente.
     */
    public function unsetController() {
        if(isset($_REQUEST['controller']))
            unset($_REQUEST['controller']);
    }

    /**
     * La funzione unsetTask cancella $_REQUEST['task'], se presente.
     */
    public function unsetTask() {
        if(isset($_REQUEST['task']))
            unset($_REQUEST['task']);
    }

    /** La funzione setData chiama la funzione assign di Smarty per inserire dati nei template.
     * @param $reference string Il nome della variabile nel file tpl.
     * @param $data mixed Il dato da passare al template Smarty.
     */
    public function setData($reference, $data) {
        $this->assign($reference, $data);
    }
}
