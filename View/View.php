<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        $this->caching = true;
    }

    public function setTemplate($template) {
        $this->display($template);
    }


    public function setDataIntoTemplate($reference, $data) {
        $this->assign($reference, $data);
    }
}
