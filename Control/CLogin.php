<?php

/**La classe CLogin è la classe relativa al caso d'uso del login e della registrazione di un utente.
 */
class CLogin {
    
    private $task;
    
    public function __construct($a){
        $this->setTask($a);
    }
    
    /**
     * @return $task Il compito da svolgere.
     */
    public function getTask(){
        return $this->task;
    }
    
    /**
     * @param string $a E' un task.
     */
    public function setTask($a){
        $this->task=$a;
    }
    
    /**La funzione 'smista' effettua un controllo in base alla variabile $a ($task); in base al valore 
     * della variabile, e quindi del task, viene chiamato il relativo metodo.
     * 
     * @return resource
     */
    public function smista() {
        $a=$this->getTask();
        switch($a) {
            case 'login': {
                $cor=$this->processaLogin();
                return $cor;
                break;
            } 
            case 'logout': {
                $this->logout();
                break;
            }
            case 'controllaEsistenzaMailL': {
                return $this->controllaMail();
                break;
            } 
            case 'controllaEsistenzaMailR': {
                return $this->controllaMail();
                break;
            } 
            case 'conferma':{
                $this->conferma();
                break;
            }
            case 'reg': {
                return $this->processaReg();
                break;
            }
            case 'controllaEsistenzaCodiceFiscale':{
               return $this->controllaCodiceFiscale();
               break;
            }
        }
    }
    
    /**Il metodo 'processaLogin' si occupa di processare il login di un utente. Nella variabile $utente viene 
     * caricato l'oggetto EUtente le cui e-mail e password corrispondono a quelle inserite dall'utente (se esiste).
     * Una volta caricato l'utente, se l'id è >=0 vengono impostati nella sessione i valori di $utente.
     * 
     * @return bool
     */
    public function processaLogin() {

        $sessione = new USession();

        if( !($sessione->getValore('idUtente'))) { // l'utente non è loggato
            $mail = $_REQUEST['email'];
            $pass = $_REQUEST['password'];
            $fute = new FUtente();
            $utente = $fute->caricaUtenteDaLogin($mail, $pass);
            if($utente!=false) { //è stato trovato un utente con mail e pass giuste
                $id = $utente->getID();
                if($id == 0) {
                    $sessione->impostaValore('idUtente',0);
                    $sessione->impostaValore('tipo','admin');
                }
                else {
                    $sessione->impostaValore('idUtente', $id);
                    $CUte = new CUtente();
                    $tipo = $CUte->controllaProfessionista($id);
                    $sessione->impostaValore('tipo', $tipo);
                }
                header('Location: index.php');
            }
            else {
                return $cor = false;
            }
        }
    }
    
    /**Il metodo 'processaReg' si occupa di processare la registrazione di un utente. La registrazione
     * può essere eseguita solo dagli utenti non autenticati. Viene creato un oggetto EUtente, passando
     * al suo costruttore i valori prelevati dalla form di registrazione. I dati dell'utente vengono 
     * quindi inseriti nel database. Viene inoltre creato un codice di attivazione che viene poi
     * spedito via e-mail all'utente che sta effettuano la registrazione. Infine viene visualizzato il 
     * template postRegistrazione.tpl.
     * 
     * @return resource|bool
     * @throws Exception
     */
    public function processaReg(){
        $sessione=new USession();
        if(!$sessione->getValore('idutente')== -1){
            $nome=ucfirst($_POST['Nome']);
            $cognome=ucfirst($_POST['Cognome']);
            $data=$this->dataItaToISO($_POST['Data']);
            $codicefiscale=$_POST['CodiceFiscale'];
            $sesso=$_POST['Sesso'];
            $emailreg=$_POST['email'];
            $password=$_POST['Password'];
            $srpassword=$_POST['RPassword'];
            if($password != $srpassword) {
                throw new Exception("Le password non coincidono");
            }
            $codice=$this->GeneraCodice();   
            $Ute = new EUtente($nome,$cognome,$data,$codicefiscale,$sesso,$emailreg,$password,$codice);
            $FUte = new FUtente();
            $FUte->inserisciUtente($Ute);
            $FCli = new FCliente();
            $FCli->aggiungiCliente($FUte->getLastID());
            $mail=new UMail();
            $oggetto='Conferma Registrazione';
            $corpoMail = "Gentile $nome $cognome, per confermare l'iscrizione al sito cliccare sul seguente link: ".
                         "http://localhost/appointment-manager/Chiamate/ALogin.php?task=conferma&code=$codice";
            $mail->inviaMail($emailreg, $nome, $oggetto, $corpoMail);
            $VIn = new VIndex();
            return $VIn->fetch('postRegistrazione.tpl');
        }
    }
    
    /**Il metodo 'conferma' si occupa di confermare la registrazione. Tramite 'controllaEsistenza' il metodo
     * conferma la registrazione dell'utente che ha il codice passato tramite $_REQUEST.
     */
    public function conferma() {
        $code=$_REQUEST['code'];
        $sessione = new USession();
        $FUte=new FUtente();
        if($FUte->controllaEsistenza('codiceconferma', $code)){
            $Ute=$FUte->caricaUtenteDaConferma($code);
            $Ute->setCodiceConferma('0');
            if($FUte->aggiornaUtente($Ute)) {
                $CUte = new CUtente();
                $id = $Ute->getID();
                $tipo = $CUte->controllaProfessionista($id);
                $sessione->impostaValore('tipo',$tipo);
                $tipo = ucfirst($tipo);
                $sessione->impostaValore('idUtente',$id);
                header("location: ../index.php?controller=pagina$tipo&id=$id");
            }
        }
        else {
            header("location: ../../index.php"); // sarebbe meglio fare il redirect a una pagina d'errore
        }
    }
    
    /**Il metodo 'controllaConferma' controlla se l'utente ha confermato la propria registrazione.
     * 
     * @return boolean Ritorna true se il codice di conferma è posto a zero, ovvero se la registrazione 
     * è stata confermata; false altrimenti.
     */
    public function controllaconferma(){
        $mail = strtolower(trim($_POST['email']));
        $FUte=new FUtente;
        $Ute=$FUte->caricaUtenteDaMail($mail);
        if($Ute->getCodiceConferma()=='0') 
        return true;
        else 
        return false;
    }
        
        
    /**Il metodo 'controllaMail' controlla se tra gli utenti registrati esiste un utente con una data e-mail.
     * Questo metodo è utilizzato per la gestione di una chiamata Ajax.
     * 
     * @return bool 
     */
    private function controllaMail() {
        $mail = trim($_POST['email']);
        $FUte = new FUtente();
        $a=$this->getTask();
        $esito = $FUte->controllaEsistenza('email',$mail);
        if($a==='controllaEsistenzaMailL'){return json_encode($esito);
        }
        elseif($a==='controllaEsistenzaMailR'){return json_encode(!$esito);}
        
    }
    
    /**Il metodo 'controllaCodiceFiscale' controlla se tra gli utenti registrati esiste un utente con 
     * una data codice fiscale. Questo metodo è utilizzato per la gestione di una chiamata Ajax.
     * 
     * @return bool
     */
    private function ControllaCodiceFiscale(){
        $codicefiscale=$_POST['CodiceFiscale'];
        $FUte = new FUtente();
        $esito=$FUte->controllaEsistenza('codiceFiscale', $codicefiscale);
        return json_encode(!$esito);
    }
    
    /**il metodo 'logout' si occupa della chiusura della sessione di un utente.
     */
    private function logout() {
        $sessione = new USession();
        $sessione->fineSessione();
    }
    
    /**'dataItaToISO' è una funzione di supporto usata dalla funzione processaReg. Si occupa di trasformare
     * una data dal formato gg/mm/aaaa al formato aaaa/mm/gg.
     * 
     * @param string $data La data nel formato gg/mm/aaaa
     * @return string La data nel formato aaaa/mm/gg
     */
    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }
    
    /**Il metodo generaCodice si occupa di generare il codice di attivazione della registrazione di un utente.
     * 
     * @return string Il codice generato casualmente
     */
    private function generaCodice(){
           $salt= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678';
           $len= strlen($salt);
           $length=8;
           $makepass   = '';
           mt_srand(10000000*(double)microtime());
           for ($i = 0; $i < $length; $i++) {
               $makepass .= $salt[mt_rand(0,$len - 1)];
           }
       	   return $makepass;
    }

    
}

