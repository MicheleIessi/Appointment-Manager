<?php

class CCalendar {

    public function impostaPagina() {
        $VCal = new VCalendar();
        return $VCal->processaTemplate();
    }

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

    public function getServiziProf($idp) {

        $FProf = new FProfessionista();
        $EProf = $FProf->caricaProfessionistaDaDB($idp);
        $nomeProf = $EProf->getNome()." ".$EProf->getCognome();
        $servProf = $EProf->getServiziOfferti();
        $VCal = new VCalendar();
        $servizi = array();
        foreach($servProf as $servizio) {
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

    public function getColonnaProfessionista() {
        $VCal = new VCalendar();
        return $VCal->fetch('colonnaCancellazione.tpl');
    }

    public function getColonnaInformazioni() {
        $VCal = new VCalendar();
        return $VCal->fetch('colonnaInformazioni.tpl');
    }

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

    private function creaEventoBackground($inizio,$fine,$giorno) {

        $singoloEvento['id'] = "NonDisponibile";
        $singoloEvento['title'] = "";
        $singoloEvento['start'] = $inizio;
        $singoloEvento['end'] = $fine;
        $singoloEvento['rendering'] = 'background';
        $singoloEvento['allDay'] = "";
        $singoloEvento['editable'] = false;
        $singoloEvento['color'] = '#FF9999';
        $singoloEvento['dow'] = [$giorno];

        return $singoloEvento;
    }

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