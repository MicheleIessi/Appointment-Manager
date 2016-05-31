<?php

class VIndex extends View {

    private $main_content = "";

    private $main_button=array();

    private $side_content = "";

    private $side_button=array();

    private $layout = 'home_default.tpl';

    public function setContent($content) {
        $this->main_content = $content;
    }

    public function mostraPagina() {
        $this->loadButtons();
        $this->assign('banner',$this->getBanner());
        $this->assign('main_content',$this->main_content);
        $this->assign('mainButtons',$this->main_button);
        $this->assign('sideButton',$this->side_button);
        $this->assign('right_content',$this->side_content);
        $this->display('home_default.tpl');
    }

    public function setSideContent($content) {
        $this->side_content=$content;
    }

    public function setSideButtons($buttons) {
        $this->side_button=$buttons;
    }

    public function aggiungiTastiLogin() {// devo fare in modo che il login si aggiunga ai main buttons
        $loginReg = array();
        $loginReg[]=array('testo'=>'Login','link'=>'#');
        $loginReg[]=array('testo'=>'Registrati','link'=>'#');
        $this->main_button=array_merge($this->main_button,$loginReg);
    }

    public function impostaPaginaOspite() {
        $this->aggiungiTastiLogin();
        $this->assign('title','Appointment Manager');
        $this->assign('main_content',$this->main_content);
        $this->assign('right_content',$this->side_content);
    }


    public function impostaPaginaRegistrato() {
        $this->assign('title','Appointment Manager');
        $this->assign('main_content',$this->main_content);
        $this->assign('right_content',$this->side_content);
        $this->aggiungiTastoLogout();
    }

    public function impostaDivProfessionisti($professionisti) { //professionisti è un array associativo contenente l'id dei professionisti nel db
        /*
         * professionisti sarà un array di array:
         * 0=> ['nome'=>'a';'cognome'=>'b';'id'=>'x']; 1=>.. e così via
         * questi professionisti saranno caricati se l'utente è loggato nella pagina del calendar
         */
        $arrayPro = array();
        foreach($professionisti as $professionista) {
            $arrayPro[] = array('nome'=>$professionista['nome']." ".$professionista['cognome'],
                                'link'=>'?controller=calendario&idp='.$professionista['id']);
        }
        $this->side_button=$arrayPro;
    }

    public function getBanner() {
        return $this->fetch('banner.tpl');
    }

    public function loadButtons() {
        global $config;
        $buttons = array();
        foreach($config['home'] as $button) {
            $buttons[]=$button;
        }
        $this->main_button = array_merge($this->main_button,$buttons);
    }
}