<?php
/**CUtente è la classe relativa al caso d'uso della visualizzazione e della modifica della pagina di
 * un utente.
 */
class CUtente {
    
    /**Il metodo 'smista' prende come parametro l'ID dell'utente dalla sessione, dal quale controlla
     * se l'utente è un 'Cliente' o un 'Professionista'. In base al risultato vengono svolti gli 
     * assegnamenti opportuni per le variabili smarty che sono presenti nel template del dato 'Cliente'
     * o del dato 'Professionista' attraverso la funzione 'setData' della classe View. Fatti gli assegnamenti
     * la funzione richiama il metodo 'impostaPaginaCliente'/'impostaPaginaProfessionista', che si occupa del
     * caricamento del template 'paginaCliente'/'paginaProfessionista'.
     * 
     * @param string $id
     * @return resource
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
                $VPro->setData('tipo', $tipoUtente);
                
                
                $idp = $sessione->getValore('idUtente');
                
                $modifica = false;
                $proprietario= false;
                
                if($idp == $id) {
                    $modifica = true;
                    $proprietario= true;
                }                
                $VPro->setData('modifica',$modifica);
                $VPro->setData('proprietario',$proprietario);                

                return $VPro->impostaPaginaProfessionista();

            default:
                break;
        
        }
        
    }
    
    /*La funzione 'processaUtente' è una funzione di supporto che processa i dati comuni sia ai clienti
     * che ai professionisti.
     * 
     * @param VUtente $VUte
     * @param EUtente $EUte
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
    
    /**La funzione 'cronologiaAppuntamenti' processa gli appuntementi del cliente in un array di oggetti 
     * EAppuntamento (mediante la funzione 'getAppuntamenti' della classe FCliente); tramite smarty 
     * questi appuntamenti verranno inseriti in una tabella in 'paginaCliente.tpl'.
     * 
     * @param string $id L'ID del 'Cliente'; viene utilizzato per il caricamento degli appuntamenti
     * passati del cliente in un array composto da oggetti EAppuntamento.
     * @return array
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
    
    /**la funzione 'serviziProfessionista' processa i servizi offerti da un professionista in un array 
     * di oggetti EServizio (mediante la funzione 'getServiziOfferti' della calsse EProfessionista);
     * tramite smarty questi appuntamenti verranno inseriti in una tabella in 'paginaProfessionista.tpl'
     * 
     * @param EProfessionista $EPro
     * @return array
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
    
    /**La funzione 'controllaProfessionista' vede se l'id passato è l'id di un professionista.
     * 
     * @param string $id l'id da controllare
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
    
    /**La funzione 'caricaImmagine' si occupa del caricamento dell'immagine del profilo di un utente. Un 
     * utente può ovviamente modificare solo l'immagine del proprio profilo; questo controllo viene effettuato
     * confrontando l'ID dell'utente preso dalla sessione con l'ID dell'utente preso dalla variabile 'controller'.
     * Il metodo verifica che effettivamente il file uploadato sia un'immagine (controllo effettuato sul 
     * mime-type dal metodo php 'getimagesize' ) e che non superi i 4 MB di memoria (a questo proposito
     * si è dovuto modificare il file php.ini). Infine il metodo fa in modo che su server l'immagine sia salvata
     * con l'ID dell'utente a cui si riferisce: in questo modo ad ogni utentepuò essere associata una ed una sola
     * immagine.
     */
    public function caricaImmagine()   {
        
        $sessione= new USession();
        $id = $sessione->getValore('idUtente');
        $paginaCorrente = $_REQUEST['utenteCorrente'];
        if($paginaCorrente != $id) {
            echo "Non puoi modificare un'immagine di un profilo non tuo, str.. furbetto...";
            exit;
        }
        // verifico che il file sia stato uploadato
        if (!isset($_FILES['immagineUtente']) || !is_uploaded_file($_FILES['immagineUtente']['tmp_name'])) {
            echo 'Errore: caricamento file non avvenuto';
            exit;
        }
        
        // verifico che il file caricato sia effettivamente un'immagine
        $is_img = getimagesize($_FILES['immagineUtente']['tmp_name']);
        
        if (!$is_img) {
            echo 'Puoi inviare solo immagini';
        exit;    
        }
        
        // controllo che il file non superi i 4 MB
        if ($_FILES['immagineUtente']['size'] > 4194304) {
            echo 'Il file è troppo grande!';
        exit;
        }
        
        // Se tutti i precedenti controlli sono superati:
        
        //percorso della cartella dove mettere i file caricati dagli utenti
        $cartellaImmagini = "../img/immaginiProfilo/";
        
        //Recupero il percorso temporaneo in cui vengono inizialmente uploadati i files
        $nomeTmp = $_FILES['immagineUtente']['tmp_name'];
        
        //recupero il nome originale del file caricato
        $nomeImmagine = $_FILES['immagineUtente']['name'];
        
        // per recuperare l'estensione del file
        $info = new SplFileInfo($nomeImmagine);
        $estensione = $info->getExtension();
        
        // chiamo l'immagine del profilo di un utente con il suo id + estensione
        $nomeImmagine= $sessione->getValore("idUtente").".$estensione";
        
        // Ricostruisco il path completo del file
        $target_file = $cartellaImmagini.$nomeImmagine;
        
        // controllo che il file non esista già   
        $mask = $cartellaImmagini.$id.".*";
        $arrImm = glob($mask);              // Inserisce in arrImm tutti i file che rispettano il pattern $mask
        array_map('unlink',$arrImm);    
        
        /* array_map prende uno alla volta gli elementi di un'array (in questo caso $arrImm) ed esegue 
         * su ognuno di essi la funzione 'unlink', la quale cancella un file relativo ad un pattern; quindi
         * in questo modo vengono cancellati tutti i files che rispettano il pattern $mask  */
        
        //Arrivati a questo punto copio il file dalla sua posizione temporanea alla mia cartella upload
        
        if (move_uploaded_file($nomeTmp, $target_file)) { 
            //Se l'operazione è andata a buon fine:
            $tipo = ucfirst($sessione->getValore('tipo'));
            $id = $sessione->getValore('idUtente');
            header("Location: ../index.php?controller=pagina$tipo&id=$id");
        }
        else{
            //Se l'operazione è fallta:
            echo 'Upload immagine non riuscito';   
        }

    }
    
    /* ------------------------------------------------------------------------------------------------------- */
    
    /**'controllaForm' effettua controlli lato server sulla form modificaUtente: in realtà tutti i controlli 
     * vengono effettuati quando vengono richiamati i metodi set di EUtente.
     * 
     * @throws Exception
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

            $EUte->setNome($nome);
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
                header("location: ../?controller=pagina$tipo&id=$id");

            }

        } catch(Exception $e) {
            $this->errore($e->getMessage());
        }
      
    }
    
    /**'errore' è una funzione di supporto usata dalla funzione controllaForm. Si occupa di mostrare a
     * video i messaggi d'errore lanciati dalle eccezioni catchate dal metodo 'controllaForm' e in questo caso
     * di redirigere l'utente alla form.
     * 
     * @param string $messaggioErrore
     */
    private function errore($messaggioErrore)   {
        $sessione = new USession();
        $sessione->impostaValore('messaggioErrore', $messaggioErrore);
        header("location: ./?controller=modificaUtente");
    }
    
    /**'dataItaToISO' è una funzione di supporto usata dalla funzione controllaForm. Si occupa di trasformare
     * una data dal formato gg/mm/aaaa al formato aaaa/mm/gg.
     * 
     * @param string $data
     * @return string
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
