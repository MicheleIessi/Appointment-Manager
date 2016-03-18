<?php
require_once 'lib/smarty/Smarty.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class View extends Smarty {
    
    protected $url;
    
    public function __construct() {
        global $config;
        parent::__construct();
        $this->setTemplateDir($config['smarty']['template_dir']);       // directory dei template
        $this->setCompileDir($config['smarty']['compile_dir']);         // directory per compilare
        $this->setConfigDir($config['smarty']['config_dir']);           // directory dei configs
        $this->setCacheDir($config['smarty']['cache_dir']);             // directory della cache
        $this->url = $config['url'];                                    // url predefinito
        
        $this->assign('url', $this->url);
        $this->caching = false;
    }
    
    public function setTemplate($template) {
        $this->display($template);
    }
    
    
    public function setDataIntoTemplate($reference, $data) {
        $this->assign($reference, $data);
    }
}
