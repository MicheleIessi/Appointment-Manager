<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/smarty/Smarty.class.php');
class View extends Smarty {
    
    protected $url;
    public function __construct() {
        parent::__construct();
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
    public function getTask() {
        if(isset($_REQUEST['task']))
            return $_REQUEST['task'];
        return false;
    }
    public function unsetController() {
        if(isset($_REQUEST['controller']))
            unset($_REQUEST['controller']);
    }
    public function unsetTask() {
        if(isset($_REQUEST['task']))
            unset($_REQUEST['task']);
    }
    public function setData($reference, $data) {
        $this->assign($reference, $data);
    }
}