<?php

class VIndex extends View {

    private $template = 'indexMic.tpl';

    public function __construct() {
        parent::__construct();
        $this->setTemplate($this->template);
    }


}