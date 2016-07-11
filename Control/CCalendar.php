<?php
/**
 * CCalendar si occupa di gestire il caso d'uso relativo alla prenotazione di un appuntamento.
 *
 * @package  Control
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class CCalendar {

    /** La funzione impostaPagina chiama il metodo processaTemplate di VCalendar e ritorna il template relativo al
     * calendario.
     * @return string Il template relativo al calendario.
     */
    public function impostaPagina() {
        $VCal = new VCalendar();
        return $VCal->processaTemplate();
    }

    /** La funzione smista si occupa di delegare a diverse funzioni diversi compiti, in base al task passato. La lista
     * dei task è la seguente:
     * * fetch: per prendere gli eventi che verranno usati da fullcalendar
     * * new: per inserire un appuntamento nel database attraverso fullcalendar
     * * delete: per cancellare un appuntamento dal database attraverso fullcalendar
     * * lista: ritorna la lista dei professionisti che offrono appuntamenti
     * @param $task string L'azione richiesta.
     * @return array|bool|string Il tipo di dato ritornato è descritto nelle funzioni interessate.
     */
    public function smista($task) {

        switch($task) {

            case 'fetch':
                $eventi = $this->fetchEventi();
                return $eventi;

            case 'new':
                $risultato = $this->aggiungiEvento();
                return $risultato;

            case 'delete':
                $risultato = $this->cancellaEvento();
                return $risultato;

            case 'lista':
                $VCal = new VCalendar();
                return $VCal->getListaProfessionisti();

            default:
                return true;

        }
    }

    /** La funzione getServiziProf manda al template relativo ai servizi offerti dal professionista un array contenente
     * i servizi opportunamente formattati. L'array contiene i campi 'nome', 'cognome', 'settore', 'durata'. In seguito
     * questo array viene assegnato alla variabile Smarty 'servizi' e viene ritornato il risultato della funzione di
     * VCalendar 'getColonnaServizi'.
     * @param $idp int L'id del professionista per il quale caricare i servizi
     * @return string Il template relativo ai servizi offerti dal professionista, opportunamente popolato.
     */
    public function getServiziProf($idp) {

        $FProf = new FProfessionista();
        $EProf = $FProf->caricaProfessionistaDaDB($idp);
        $nomeProf = $EProf->getNome()." ".$EProf->getCognome();
        $servProf = $EProf->getServiziOfferti();
        $VCal = new VCalendar();
        $servizi = array();
        foreach($servProf as $servizio) {
            /* @var $servizio EServizio */
            $arraySer = array();
            $arraySer['nome'] = $servizio->getNomeServizio();
            $arraySer['descrizione'] = $servizio->getDescrizione();
            $arraySer['settore'] = $servizio->getSettore();
            $arraySer['durata'] = $servizio->getDurata();
            array_push($servizi,$arraySer);
        }
        $VCal->setData('nomeProf',$nomeProf);
        $VCal->setData('servizi',$servizi);
        return $VCal->getColonnaServizi();
    }

    /** La funzione getColonnaProfessionista ritorna il template colonnaCancellazione attraverso una chiamata a funzione
     * della classe VCalendar.
     * @return string Il template relativo al caso professionista - proprietario.
     */
    public function getColonnaProfessionista() {
        $VCal = new VCalendar();
        return $VCal->fetch('colonnaCancellazione.tpl');
    }

    /** La funzione getColonnaInformazioni ritorna il template colonnaInformazioni attraverso una chiamata a funzione
     * della classe VCalendar.
     * @return string Il template relativo al caso professionista - non proprietario.
     */
    public function getColonnaInformazioni() {
        $VCal = new VCalendar();
        $id = $_REQUEST['idp'];
        $FProf = new FProfessionista();
        $EProf = $FProf->caricaProfessionistaDaDB($id);
        $nomeProf = $EProf->getNome() . " " . $EProf->getCognome();
        $VCal->setData('nomeProf',$nomeProf);        
        return $VCal->fetch('colonnaInformazioni.tpl');
    }

    /** La funzione aggiungiEvento viene chiamata in maniera asincrona tramite azione sull'agenda fullcalendar e si
     * occupa di inserire un evento al database. Prima di farlo, però, si assicura che l'utente che vuole effettuare la
     * prenotazione con un dato professionista abbia meno di 3 prenotazioni attive, cioè relative a date future, e quindi
     * non ancora avvenute.
     * @return array Array contenente un esito e un messaggio.
     */
    public function aggiungiEvento() {
        $sessione = new USession();
        $idUtente = $sessione->getValore('idUtente');
        $idProf = $sessione->getValore('idCalendario');
        $FCli = new FCliente();
        $FSer = new FServizio();
        $FApp = new FAppuntamento();
        $risultato = array();
        $inizio = explode('T',$_REQUEST['orarioInizio']);
        $data = $inizio[0];

        $arr = $FCli->getAppuntamentiFuturi($idUtente,$idProf);

        if(sizeof($arr) < 3) {

            $orarioInizio = $inizio[1];
            $title = $_REQUEST['servizio'];//nome del servizio
            $ESer = $FSer->caricaServizioDaDb($title);

            $appuntamento = new EAppuntamento($idProf, $idUtente, $data, $orarioInizio, $ESer);
            $FApp->inserisciAppuntamento($appuntamento);
            $IDApp = $FApp->getLastID();
            if($IDApp == 0) {
                $risultato['stato'] = 'errore';
                $risultato['messaggio'] = 'Si può effettuare una prenotazione per giorno con lo stesso professionista';
            }
            else {
                $EApp = $FApp->caricaAppuntamentoDaDb($IDApp);
                $risultato['stato'] = 'successo';
                $risultato['messaggio'] = 'Appuntamento aggiunto correttamente per il giorno '.$EApp->getData().' alle ore '.$EApp->getOrario().'.';
                $risultato['idAppuntamento'] = $IDApp;
            }
        }
        else {
            $risultato['stato'] = 'errore';
            $risultato['messaggio'] = 'Non si possono avere più di 3 prenotazioni attive con lo stesso professionista';
        }
        return $risultato;

    }

    /** La funzione fetchEventi si di popolare l'agenda fullcalendar di eventi, in particolare:
     * <ul><li>Crea eventi relativi agli orari in cui il professionista non è disponibile attraverso la funzione generaEventiOrari</li>
     * <li>Crea eventi relativi agli appuntamenti che il professionista ha già in programma. In questo caso la funzione</li>
     *   cambia il tipo di evento da visualizzare in base all'utente che richiede la fetch:
     *   <ul><li>cliente: il cliente non può vedere i dettagli di nessun appuntamento, a parte i suoi</li>
     *   <li>professionista proprietario: il professionista vede i dettagli di ogni appuntamento</li>
     *   <li>professionista non proprietario: il professionista non vede i dettagli di nessun appuntamento</li></ul></ul>
     * @return array Un array di eventi opportunamente formattati per essere letti da fullcalendar.
     */
    public function fetchEventi() {

        $sessione = new USession();
        $idUtente = $sessione->getValore('idUtente');
        $idProf = $sessione->getValore('idCalendario');
        $tipo = $sessione->getValore('tipo');
        $events = array();

        /* INIZIALIZZO ISTANZE DEGLI OGGETTI CHE MI SERVIRANNO */

        $FPro = new FProfessionista();
        $FUte = new FUtente();
        $FAge = new FAgenda();

        /* QUI CARICO GLI ORARI IN CUI IL PROFESSIONISTA NON E' DISPONIBILE E LI INSERISCO SOTTO FORMA DI EVENTI BACKGROUND */
        $EPro = $FPro->caricaProfessionistaDaDB($idProf);
        $impegni = $EPro->getOrariLavorativi();
        $arrBackground = $this->generaEventiOrari($impegni);
        foreach($arrBackground as $giorno) {
            array_push($events,$giorno);
        }

        $agenda = $FAge->caricaAgenda($idProf);
        $impegni = $agenda->getImpegni();
        foreach ($impegni as $appuntamento) {
            /* @var $appuntamento EAppuntamento */
            $evento = array();
            //attributi che non dipendono dal tipo di utente che ha richiesto il calendario
            $evento['id'] = $appuntamento->getIDAppuntamento();
            $evento['start'] = $appuntamento->getData()." ".$appuntamento->getOrario();
            $durata = $appuntamento->getVisita()->getDurata();
            $evento['end'] = $this->processa($evento['start'], $durata);
            $evento['allDay'] = "";
            $evento['editable'] = false;
            if ($tipo == 'cliente') {
                $idCliente = $appuntamento->getIDCliente();
                if($idCliente == $idUtente) {
                    $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con te";
                    $evento['backgroundColor'] = '#ADFF7E';
                    $evento['textColor'] = '#000000';
                    $evento['borderColor'] = '#31DA17';
                    $dueGiorni = new DateTime();
                    $dueGiorni->modify('+2 day');
                    $dataApp = new DateTime($appuntamento->getData()." ".$appuntamento->getOrario());
                    if($dataApp > $dueGiorni) {
                        $evento['editable'] = true;
                    }
                }
                else {
                    $evento['title'] = 'Orario già prenotato';
                    $evento['color'] = '#AAAAAA';
                    $evento['textColor'] = '#FFFFFF';
                }
            }
            else if ($tipo == 'professionista') {
                if($idUtente == $idProf) {
                    $idCliente = $appuntamento->getIDCliente();
                    $utente = $FUte->caricaUtenteDaDb($idCliente);
                    $nomeUtente = $utente->getNome();
                    $cognomeUtente = $utente->getCognome();
                    $evento['title'] = "{$appuntamento->getVisita()->getNomeServizio()} con $nomeUtente $cognomeUtente";
                    $evento['editable'] = true;
                }
                else {
                    $evento['title'] = 'Orario già prenotato';
                    $evento['color'] = '#AAAAAA';
                    $evento['textColor'] = '#FFFFFF';
                }
            }

            array_push($events, $evento);
        }
        return $events;
    }

    /** La funzione cancellaEvento cancella un evento dal database attraverso l'agenda fullcalendar. Raccoglie l'id
     * dell'appuntamento e una motivazione inserita dall'utente attraverso la variabile superglobale $_REQUEST. Si
     * occupa in seguito dell'invio di una mail di notifica di cancellamento all'utente/professionista interessato.
     * @return array Array contenente uno stato e un messaggio.
     */
    public function cancellaEvento() {

        $sessione = new USession();
        $tipo = $sessione->getValore('tipo');

        $FApp = new FAppuntamento();
        $FPro = new FProfessionista();
        $FUte = new FUtente();
        $UMail = new UMail();

        $idAppuntamento = $_REQUEST['idApp'];
        $motivazione = $_REQUEST['motivo'];

        $risultato = array();
        $app = $FApp->caricaAppuntamentoDaDb($idAppuntamento);
        $idp = $app->getIDProfessionista();
        $idc = $app->getIDCliente();
        $esito = $FApp->cancellaAppuntamento($idAppuntamento);
        $EPro = $FPro->caricaProfessionistaDaDB($idp);
        $ECli = $FUte->caricaUtenteDaDb($idc);
        $nomePro = $EPro->getNome()." ".$EPro->getCognome();
        $nomeCli = $ECli->getNome()." ".$ECli->getCognome();
        $mailPro = $EPro->getEmail();
        $mailCli = $ECli->getEmail();
        if ($esito == true) {
            if($tipo == 'cliente') {

                $oggetto = "Cancellazione appuntamento n° ".$app->getIDAppuntamento().".";
                $corpo = "Gentile $nomePro, la informiamo che l'utente $nomeCli ($mailCli) ha cancellato la"
                    ." sua prenotazione per il giorno ".$app->getData()." delle ore ".$app->getOrario().
                    ". Motivazione: '$motivazione'.";
                $UMail->inviaMail($mailPro,$nomePro,$oggetto,$corpo);
            }
            else if($tipo == 'professionista') {

                $oggetto = "Cancellazione appuntamento del giorno ".$app->getData()." delle ore ".$app->getOrario().".";
                $corpo = "Gentile $nomeCli, la informiamo che il professionista $nomePro ($mailPro) ha cancellato la"
                    ." sua prenotazione per il giorno ".$app->getData()." delle ore ".$app->getOrario().
                    ". Motivazione: '$motivazione'.";
                $UMail->inviaMail($mailCli,$nomeCli,$oggetto,$corpo);
            }
            $risultato['stato'] = 'successo';
            $risultato['messaggio'] = 'Appuntamento cancellato con successo ';
        } else {
            $risultato['stato'] = 'errore';
            $risultato['messaggio'] = 'Impossibile cancellare l\'appuntamento';
        }
        return $risultato;

    }

    /** La funzione processa prende in input un orario d'inizio del formato yyyy-mm-dd hh:mm:ss e una durata del formato
     * hh:mm:ss e aggiunge la durata all'orario d'inizio, creando quindi un intervallo e restituendo l'orario di fine.
     * @param $inizio string L'orario d'inizio formattato secondo il pattern yyyy-mm-dd hh:mm:ss
     * @param $durata string Una stringa che rappresenta una durata formattata secondo il pattern hh:mm:ss
     * @return string L'orario di fine formattato secondo il pattern yyyy-mm-dd hh:mm:ss
     */
    private function processa($inizio,$durata) {
        $parti = array_map(function($num) {
            return (int) $num;
        }, explode(':', $durata));

        $inizioConvertito = new DateTime($inizio);
        $durataConvertita = new DateInterval(sprintf('PT%uH%uM%uS',$parti[0],$parti[1],$parti[2]));
        $inizioConvertito->add($durataConvertita);
        $fineConvertita = $inizioConvertito->format('Y-m-d H:i:s');
        return $fineConvertita;
    }

    /**La funzione creaEventoBackground crea un evento processabile da fullcalendar a partire da tre parametri.
     * @param $inizio string L'orario d'inizio formattato secondo il pattern yyyy-mm-ss hh:mm:ss
     * @param $fine string L'orario di fine formattato secondo il pattern yyyy-mm-ss hh:mm:ss
     * @param $giorno string se l'evento deve essere ripetuto settimanalmente, rappresenta il giorno in cui deve essere ripetuto (da 0 a 6)
     * @return mixed L'array, rappresentante l'evento, creato opportunamente per essere processato da fullcalendar.
     */
    private function creaEventoBackground($inizio,$fine,$giorno) {

        $singoloEvento['id'] = "NonDisponibile";
        $singoloEvento['title'] = "";
        $singoloEvento['start'] = $inizio;
        $singoloEvento['end'] = $fine;
        $singoloEvento['rendering'] = 'background';
        $singoloEvento['allDay'] = "";
        $singoloEvento['editable'] = false;
        $singoloEvento['color'] = '#FF9999';
        $singoloEvento['dow'] = array($giorno);

        return $singoloEvento;
    }

    /** La funzione generaEventiOrari si occupa di convertire gli orari di lavoro di un professionista in modo da essere
     * processati correttamente da fullcalendar. Ad esempio, se un professionista ha come orario lavorativo 08:00:00-16:00:00,
     * questo metodo crea eventi background per le fasce orarie 00:00:00-08:00:00 e 16:00:00-24:00:00. Questo metodo
     * funziona correttamente per qualsiasi numero di fasce orarie in un orario lavorativo.
     * @param $arrayOrari array Array di 7 stringhe rappresentanti orari, divisi per giorno.
     * @return array Array di eventi background creati a partire dagli orari lavorativi del professionista.
     */
    private function generaEventiOrari($arrayOrari) {
        $orariConvertiti = array();
        $i=0;   //rappresenta il giorno della settimana
        foreach($arrayOrari as $giorno) {
            $orari = explode(',', $giorno);
            // devo prendere gli intervalli a due a due e fare la stessa cosa praticamente
            $numeroIntervalli = count($orari);
            //inserisco il primo evento background
            $primoOrario = explode('-',$orari[0]);
            $primoEvento = $this->creaEventoBackground('00:00:00',$primoOrario[0],$i);
            array_push($orariConvertiti, $primoEvento);
            //inserisco gli eventi intermedi
            for ($k=0; $k < $numeroIntervalli-1; $k++) {
                $intervallo1 = explode('-',$orari[$k]);
                $intervallo2 = explode('-',$orari[$k+1]);
                $inizio = $intervallo1[1];
                $fine = $intervallo2[0];
                $eventoInMezzo = $this->creaEventoBackground($inizio,$fine,$i);
                array_push($orariConvertiti, $eventoInMezzo);
            }

            $ultimoOrario = explode('-',$orari[$numeroIntervalli-1]);
            $intervallo2 = $ultimoOrario[1];
            $ultimoEvento = $this->creaEventoBackground($intervallo2,'24:00:00',$i);
            array_push($orariConvertiti,$ultimoEvento);
            $i++;
        }
        return $orariConvertiti;
    }

}