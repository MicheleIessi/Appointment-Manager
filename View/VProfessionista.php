<?php
/**
 * VProfessionista si occupa di gestire la visualizzazione della pagina del professionista.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VProfessionista extends View {

    /** La funzione impostaPaginaProfessionista si occupa di popolare il template relativo alla pagina del cliente richiesta.
     * Prende l'id del professionista di cui si vuole visualizzare la pagina dalla variabile superglobale $_REQUEST e imposta
     * le variabili Smarty relative al template della pagina del professionista.
     * @return string Il template relativo alla pagina del professionista.
     */
    public function impostaPaginaProfessionista()  {
        $id = $_REQUEST['id'];
        $result = glob("./img/immaginiProfilo/$id.*");
        if(isset($result[0])) {
            $immagine = $result[0];
        }
        else
            $immagine = false;
        $this->setData('immagine', $immagine);

        return $this->fetch('paginaProfessionista.tpl');
    }
}
