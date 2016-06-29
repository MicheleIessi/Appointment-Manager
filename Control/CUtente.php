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
                
                $VCli->setData('cronologia', $this->cronologiaAppuntamentiCliente($id));
                
                return $VCli->impostaPaginaCliente();
        
            case 'professionista':
                
                $VPro= new VProfessionista();
                $FPro= new FProfessionista();
                $EPro= $FPro->caricaProfessionistaDaDB($id);

                $this->processaUtente($VPro, $EPro);
                $VPro->setData('settore', $EPro->getSettore());      // Sempre se vogliamo tenerlo
                $VPro->setData('orariLavorativi',$EPro->getOrariLavorativi());
                $VPro->setData('serviziOfferti', $EPro->getServiziOfferti());
                $VPro->setData('serviziOfferti', $this->serviziProfessionista($EPro));
                
                /* Se prendo gli orari lavorativi del professionista, e li rendo un array, posso costruire una 
                stringa del tipo 
                 * lun -> ****
                 * mar -> ****
                 * mer -> ****
                 * e così via; in questo modo posso inserire il tutto in un div (o in una table) 
                 * in modo tale che gli orari del professionista siano visibili sulla sua pagina   
                */
                
                //$this->processaOrari($EPro);
                
                return $VPro->impostaPaginaProfessionista();

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
    
    public function cronologiaAppuntamentiCliente($id)    {
        
        $FCli= new FCliente();
        $arrayApp= $FCli->getAppuntamenti($id);      //array di oggetti EAppuntamento
        $arrayCronologia = array();
        $FUte= new FUtente();
        foreach ($arrayApp as $appuntamento) {
            $EUte= $FUte->caricaUtenteDaDb($appuntamento->getIDProfessionista());
            $nomeProf = $EUte->getNome() . " " . $EUte->getCognome();
            $idProf = $EUte->getID();
            $nomeSer = $appuntamento->getVisita()->getNomeServizio();
            $data = $appuntamento->getData();
            $orario = $appuntamento->getOrario();
            $rigaCronologia = array(
                'data'     => $data,
                'orario'   => $orario,
                'nomeServ' => $nomeSer,                
                'nomeProf' => $nomeProf,
                'idProf'   => $idProf
            );
            
            array_push($arrayCronologia,$rigaCronologia);
            
        }
        return $arrayCronologia;
    }
    
    public function serviziProfessionista(EProfessionista $EPro) {
        $serviziOfferti= $EPro->getServiziOfferti();
        $arrayServizi= array();
        
        foreach ($serviziOfferti as $ser) {
            
            $nomeSer= $ser->getNomeServizio();
            $settore= $ser->getSettore();
            $durata= $ser->getDurata();
            $descrizione= $ser->getDescrizione();
            
            $servizio= array(
                'nomeServizio'  =>  $nomeSer,
                'settore'       =>  $settore,
                'durata'        =>  $durata,
                'descrizione'   =>  $descrizione
            );
            
            array_push($arrayServizi,$servizio);
            
        }
        
        return $arrayServizi;
        
    }
    
    
}
