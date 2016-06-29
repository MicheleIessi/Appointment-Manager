<?php

class CUtente {
    
    public function smista($id)    {
        $sessione = new USession();
        $tipoUtente = $sessione->getValore('tipo'); //cliente o professionista
        
        switch ($tipoUtente) {
            case 'cliente': 
                $VCli= new VCliente;
                $FCli= new FUtente();
                $ECli= $FCli->caricaUtenteDaDb($id);

                $this->processaUtente($VCli, $ECli);
                
                
                return $VCli->impostaPaginaCliente();
        
            case 'professionista':
                $VPro= new VProfessionista();
                $FPro= new FProfessionista();
                $EPro= $FPro->caricaProfessionistaDaDB($id);

                $this->processaUtente($VPro, $EPro);
                $VPro->setData('settore', $EPro->getSettore());      // Sempre se vogliamo tenerlo
                
                /* Se prendo gli orari lavorativi del professionista, e li rendo un array, posso costruire una 
                stringa del tipo 
                 * lun -> ****
                 * mar -> ****
                 * mer -> ****
                 * e così via; in questo modo posso inserire il tutto in un div (o in una table) 
                 * in modo tale che gli orari del professionista siano visibili sulla sua pagina   
                */
                
                //$this->processaOrari($EPro);
                
                return $VPro->impostaPaginaProfessionista();    // DEVO ANCORA FARE IL TEMPLATE!!!

            default:
                break;
        
        }
        
    }
    
    public function processaUtente($VUte, $EUte)   {
        
        $VUte->setData('nomeUtente', $EUte->getNome()." ".$EUte->getCognome());
        $VUte->setData('numID', $EUte->getID());
        $VUte->setData('nome', $EUte->getNome());
        $VUte->setData('cognome', $EUte->getCognome());
        $VUte->setData('dataNascita', $EUte->getDataNascita());
        $VUte->setData('sesso', $EUte->getSesso());
        $VUte->setData('codiceFiscale', $EUte->getCodiceFiscale());
        $VUte->setData('email', $EUte->getEmail());
                
    }
    
    public function cronologiaAppuntamentiCliente($VCli, $ECli)    {
        $FPro = new FProfessionista();
        
    }
}
