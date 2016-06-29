<?php

class VCalendar extends View {

    private $layout = 'default'; //layout di default

    public function processaTemplate() {
        $view = new VIndex();
        $task = $view->getTask();
        switch($task) {
            case 'lista':
                return $this->fetch('listaProfessionisti.tpl');
            default:
                return $this->fetch('calendario_'.$this->layout.'.tpl');
        }
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function getColonnaServizi() {
        return $this->fetch('colonna_servizi.tpl');
    }
}