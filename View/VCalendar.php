<?php

class VCalendar extends View {

    private $layout = 'default'; //layout di default

    public function processaTemplate() {
        $view = new VIndex();
        if($view->getTask() == 'lista') {
            return $this->fetch('listaProfessionisti.tpl');
        }
        return $this->fetch('calendario_'.$this->layout.'.tpl');
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

}