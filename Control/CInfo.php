<?php

class CInfo {

    public function smista() {
        $view = new VIndex();

        switch($view->getTask()) {
            case 'informazioni': {

                $VInfo = new VInfo();
                return $VInfo->impostaTemplateInformazioni();
            }
                break;
            case 'credits': {

                $VInfo = new VInfo();
                return $VInfo->impostaTemplateCredits();
            }
                break;
            default: ;
        }
    }


}