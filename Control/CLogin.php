<?php
require_once('includes/autoload.inc.php');
/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 24/05/2016
 * Time: 21:14
 */
//QUESTIONI DI SICUREZZA: in questo modo non è possibile accedere direttamente al file senza passare dei parametri tramite post
class CLogin {

    public function processaLogin($utente){
        $sessione = new USession();
        //if(!$sessione->getValore('id')) {
            //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              //  if (isset($_POST['btnLogin'])) {
                    //$mail = $_POST['email'];
                    //$pass = $_POST['password'];

                    /**
                     * GESTIRE IL LOGIN:
                     * 1. vedere se la mail è presente nel db
                     *    -> se non c'è, scrivere un messaggio che informa di questo (ajax?)
                     * 2. se la mail è presente, vedere se la password associata all'utente è giusta
                     *    -> se non lo è, scrivere un messaggio di errore
                     * 3. se la mail è presente e la pass associata è corretta, verificare se l'utente ha scelto di rimanere
                     *    connesso e creare una sessione
                     */

                    //$fute = new FUtente();
                    //$utente = $fute->caricaUtenteDaLogin($mail, $pass);
                    //if($utente!=false) { //è stato trovato un utente con mail e pass giuste
                        $sessione->impostaValore('idUtente',$utente->getID());
                        
                        //  }


                   // }

               // }
      //      }
      //  else {
            //utente già loggato
      //  }
        }

    public function smista() {
        echo "ciao";
    }
}

