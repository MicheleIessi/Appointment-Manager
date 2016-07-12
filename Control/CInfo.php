<?php
/**
 * La classe CInfo è la classe che si occupa dell'impostazione del template relativo alla sezione 'chi siamo'
 * o alla sezione 'credits'
 */
class CInfo {
    
    /**Il metodo 'smista' effettua un controllo sulla variabile 'controller' di VIndex; In base al
     * valore di questa variabile viene richiamato il metodo 'impostaTemplateInformazione/Credits' della
     * classe VInfo, che si occuperà della effettiva visualizzazione del template.
     * 
     * @return resource
     */
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