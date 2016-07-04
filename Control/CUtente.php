<?php

/* 
 * CUtente è la classe relativa al caso d'uso "Visualizzazione e modifica della 
 * pagina di un utente"
*/
class CUtente {
    
    /*
    *   La funzione smista controlla dalla sessione se l'utente è un cliente o 
    *   un professionista, e imposta la relativa pagina.
    */
    
    public function smista($id)    {
        $sessione = new USession();
        $tipoUtente = $sessione->getValore('tipo'); //cliente o professionista
        $paginaDaMostrare =$sessione->getValore('paginaDaMostrare');
        switch ($paginaDaMostrare) {
            case 'cliente':
                
                $VCli= new VCliente;
                $FCli= new FUtente();
                $ECli= $FCli->caricaUtenteDaDb($id);

                $this->processaUtente($VCli, $ECli);
                
                $idc = $sessione->getValore('idUtente');
                $modifica = false;
                if($idc == $id) {
                    $modifica = true;
                }
                $VCli->setData('modifica',$modifica);
                
                $idc = $sessione->getValore('idUtente');
                $modifica = false;
                if($idc == $id) {
                    $modifica = true;
                }
                $VCli->setData('modifica',$modifica);
                
                $VCli->setData('cronologia', $this->cronologiaAppuntamentiCliente($id));
                
                return $VCli->impostaPaginaCliente();
        
            case 'professionista':
                
                $VPro= new VProfessionista();
                $FPro= new FProfessionista();
                $EPro= $FPro->caricaProfessionistaDaDB($id);

                $this->processaUtente($VPro, $EPro);
                $VPro->setData('settore', $EPro->getSettore());      // Sempre se vogliamo tenerlo
                $VPro->setData('orariLavorativi',$EPro->getOrariLavorativi());
                $VPro->setData('serviziOfferti', $this->serviziProfessionista($EPro));
                
                $idp = $sessione->getValore('idUtente');
                $modifica = false;
                if($idp == $id) {
                    $modifica = true;
                }                
                $VPro->setData('modifica',$modifica);
                
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
    
    /*  
     *  La funzione processaUtente è una funzione di supporto che processa i 
     *  dati comuni sia ai clienti che ai professionisti
    */
    
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
    
    /*
     *  La funzione cronologiaAppuntamenti processa gli appuntementi del cliente
     *  in un array che poi tramite smarty verranno inseriti in una tabella  
    */
    
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
    /*
     *  la funzione servizi professionista processa i servizi offerti da un 
     *  professionista in un array, che poi tramite smarty verranno inseriti
     *  in una tabella
    */
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
    
    /**
     * La funzione controllaProfessionista vede se l'id passato è l'id di un professionista.
     * @param type $id l'id da controllare
     * @return boolean true se l'id appartiene a un professionista, false altrimenti
     */
    public function controllaProfessionista($id) {
        $FPro = new FProfessionista();
        $profDisponibili = $FPro->caricaProfessionisti();
        $idDisponibili = array();
        foreach($profDisponibili as $professionista) {
            /* @var $professionista EProfessionista */
            array_push($idDisponibili,$professionista->getID());
        }
        $esito = 'cliente';
        if(array_search($id, $idDisponibili) !== false) {
            $esito = 'professionista';
        }
        return $esito;
    }
    
    //--------------------------------------------------------------------------
    
    /*
     * Controlli lato server sulla form modificaUtente: in realtà tutti i controlli vengono effettuati quando
     * vengono chiamati i metodi set di EUtente
    */
    
    public function controllaForm() {
        
        $sessione= new USession();

        $FUte= new FUtente();
        $EUte= $FUte->caricaUtenteDaDb($sessione->getValore('idUtente'));

        // Recupero le variabili da $_REQUEST

        $nome= ucfirst($_REQUEST['nome']);
        $cognome= ucfirst($_REQUEST['cognome']);
        $dataNascita= $this->dataItaToISO($_REQUEST['dataNascita']);
        $codiceFiscale= $_REQUEST['codiceFiscale'];
        $sesso= $_REQUEST['sesso'];
        $email= $_REQUEST['email'];
        $password1= $_REQUEST['password1'];
        $password2= $_REQUEST['password2'];

        try {

            $EUte->setNome($nome);      // controllo sulla lunghezza già presente in setNome
            $EUte->setCognome($cognome);
            $EUte->setCodFis($codiceFiscale);
            $EUte->setDataNascita($dataNascita);
            $EUte->setSesso($sesso);
            $EUte->setEmail($email);

            if($password1==$password2)  {
                $EUte->setPassword($password1);
            }
            else {
                throw new Exception('Non hai messo password uguali.');
            }
            if($FUte->aggiornaUtente($EUte)) {
                $tipo = ucfirst($sessione->getValore('tipo'));
                $id = $sessione->getValore('idUtente');
                header("location: ./?controller=pagina$tipo&id=$id");

            }


        } catch(Exception $e) {
            $this->errore($e->getMessage());
        }
        
    }
    
    /*
     * errore è una funzione di supporto usata dalla funzione controllaForm
     */
    
    private function errore($messaggioErrore)   {
        $sessione = new USession();
        $sessione->impostaValore('messaggioErrore', $messaggioErrore);
        header("location: ./?controller=modificaUtente");
    }
    
    /*
     * dataItaToISO è una funzione di supporto usata dalla funzione controllaForm
     */
    
    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }

    
}
