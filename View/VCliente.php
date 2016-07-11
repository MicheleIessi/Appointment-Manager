<?php
/**
 * VCliente si occupa di gestire la visualizzazione della pagina del cliente.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VCliente extends View {

    /** La funzione impostaPaginaCliente si occupa di popolare il template relativo alla pagina del cliente richiesta.
     * Prende l'id del cliente di cui si vuole visualizzare la pagina dalla variabile superglobale $_REQUEST e imposta
     * le variabili Smarty relative al template della pagina del cliente.
     * @return string Il template relativo alla pagina del cliente.
     */
    public function impostaPaginaCliente()  {

        $id = $_REQUEST['id'];
        $result = glob("./img/immaginiProfilo/$id.*");
        if(isset($result[0])) {
            $immagine = $result[0];
        }
        else
            $immagine = false;
        $this->setData('immagine', $immagine);
        return $this->fetch('paginaCliente.tpl');
    }
}