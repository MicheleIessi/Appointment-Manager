<?php

class VCliente extends View {
    
    public function impostaPaginaCliente()  {
        return $this->fetch('paginaCliente.tpl');
    }
}
