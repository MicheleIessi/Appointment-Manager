<?php

class VCalendar extends View
{

    private $layout = 'default'; //layout di default

    public function processaTemplate()
    {
        $view = new VIndex();
        $task = $view->getTask();
        switch ($task) {
            case 'lista':
                return $this->fetch('listaProfessionisti.tpl');
            default:
                return $this->fetch('calendario_' . $this->layout . '.tpl');
        }
    }

    public function getListaProfessionisti() {
        $FPro = new FProfessionista();
        $arrayProf = $FPro->caricaProfessionisti();
        $arrayLink = $this->getArrayPerLink($arrayProf);
        $this->setData('prof',$arrayLink);
        return $this->fetch('listaProfessionisti.tpl');
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function getColonnaServizi()
    {
        return $this->fetch('colonna_servizi.tpl');
    }

    public function getColonnaProfessionista() {
        return $this->fetch('colonnaCancellazione.tpl');
    }

    public function getColonnaInformazioni() {
        return $this->fetch('colonnaInformazioni.tpl');
    }

    private function getArrayPerLink($arrayProf) {

        $arrayLink = array();
        foreach($arrayProf as $professionista) {
            $profLink = array();
            $profLink['id'] = $professionista->getID();
            $profLink['nome'] = $professionista->getNome();
            $profLink['cognome'] = $professionista->getCognome();
            array_push($arrayLink,$profLink);
        }
        return $arrayLink;
    }

}