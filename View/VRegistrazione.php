<?php

/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 27/05/2016
 * Time: 19:08
 */
class VRegistrazione extends View {

    private $layout = 'default';

    public function processaTemplate() {
        $contenuto=$this->fetch('registrazione_'.$this->getLayout().'.tpl');
        return $contenuto;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

}