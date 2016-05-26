<?php

class VCalendar extends View {

    private $layout = 'default'; //layout di default

    public function processaTemplate() {
        return $this->fetch('calendario_'.$this->layout.'.tpl');
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

}