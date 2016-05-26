<?php

class VIndex extends View {
//provo a seguire le orme di bookstore

    private $main_content = "";

    private $main_button=array();

    private $side_content = "";

    private $side_button=array();

    private $layout = 'home_default.tpl';

    public function setContent($content) {
        $this->main_content = $content;
    }

    public function mostraPagina() {

        $this->assign('content',$this->main_content);
        $this->display('home_default.tpl');

    }

}