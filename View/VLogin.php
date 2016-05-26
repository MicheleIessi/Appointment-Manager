<?php

class VLogin extends View {

    private $template = 'login.tpl';

    public function __construct() {
        parent::__construct();
        $this->setTemplate($this->template);
    }

}