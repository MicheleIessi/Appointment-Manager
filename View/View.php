<?php

class View extends Smarty {
    
    protected $url;

    public function __construct() {
        parent::__construct();
        require('includes/config.inc.php');
        global $config;
        $this->setTemplateDir($config['smarty']['template_dir']);       // directory dei template
        $this->setCompileDir($config['smarty']['compile_dir']);         // directory per compilare
        $this->setConfigDir($config['smarty']['config_dir']);           // directory dei configs
        $this->setCacheDir($config['smarty']['cache_dir']);             // directory della cache
        $this->caching = false;
    }

    public function setTemplate($template) {
        $this->display($template);
    }

    public function getController() {
        if(isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        return false;
    }

    public function getAction() {
        if(isset($_REQUEST['action']))
            return $_REQUEST['action'];
        return false;
    }

    public function unsetController() {
        if(isset($_REQUEST['controller']))
            unset($_REQUEST['controller']);
    }

    public function unsetAction() {
        if(isset($_REQUEST['action']))
            unset($_REQUEST['action']);
    }

    public function setDataIntoTemplate($reference, $data) {
        $this->assign($reference, $data);
    }
}
