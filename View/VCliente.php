<?php

class VCliente extends View {
    
    public function impostaPaginaCliente()  {
        $sessione = new USession();
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