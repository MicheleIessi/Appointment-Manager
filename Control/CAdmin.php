<?php

class CAdmin {

    public function smista($task) {
        try {
        switch($task) {
            case 'aggiungiProf':
                $this->aggiungiProfessionista();
                break;
            case 'modificaOrari':
                $this->modificaOrariProf();
                break;
            case 'aggiungiServizio':
                $this->aggiungiServizio();
                break;
            case 'modificaServizio':
                $this->modificaServizio();
                break;
            case 'rimuoviServizio':
                $this->rimuoviServizio();
                break;
            case 'assegnaServizio':
                $this->assegnaServizio();
                break;
            case 'modificaInfo':
                $this->modificaInfo();
                break;

            //chiamate ajax
            case 'ajaxServ':
                $this->dettagliServizio();
                break;
            case 'ajaxOrari':
                $this->dettagliOrari();
                break;
            case 'ajaxServProf':
                $this->dettagliServiziProf();
                break;
            case 'ajaxAltriServ':
                $this->dettagliAltriServiziProf();
                break;

            default: header('Location: ../../index.php');
        }
        } catch (Exception $e) {
            $this->errore($e->getMessage());
        }
    }


    private function aggiungiProfessionista() {

        $FPro = new FProfessionista();

        $VAdm = new VAdmin();
        $datiInseriti = $VAdm->getDatiAggiuntaProf();

        $datiProf = $datiInseriti['persona'];
        $orari = $datiInseriti['orari'];
        // Dati utente
        $nome       = $datiProf['nome'];
        $cognome    = $datiProf['cognome'];
        $dataNas    = $this->dataItaToISO($datiProf['dataNascita']);
        $codFis     = $datiProf['codiceFiscale'];
        $sesso      = $datiProf['sesso'];
        $email      = $datiProf['email'];
        $pass       = $datiProf['pass1'];
        // Dati professionista
        $settore    = $datiProf['sett'];
        $servizi    = array();
        // Creazione EProfessionista. Il professionista appena creato non ha servizi offerti.
        $Prof = new EProfessionista($nome,$cognome,$dataNas,$codFis,$sesso,$email,$pass,"0",null,$servizi,$settore,$orari);

        $FPro->inserisciProfessionista($Prof);
        header('Location: ../../index.php');

    }

    private function modificaOrariProf() {
        $FPro = new FProfessionista();

        $VAdm = new VAdmin();
        $risultato = $VAdm->getModificheOrari();
        $id = $risultato['idProf'];
        $orari = $risultato['orari'];
        $Prof = $FPro->caricaProfessionistaDaDB($id);
        $Prof->setOrariLavorativi($orari);
        $FPro->aggiornaProfessionista($Prof);
        header('Location: ../../index.php'); //sarebbe meglio una json_encode con un messaggio ajax
    }

    private function aggiungiServizio() {
        $FSer = new FServizio();

        $VAdm = new VAdmin();
        $risultato = $VAdm->getInserimentoSer();

        $nome = $risultato['nome'];
        $descrizione = $risultato['descrizione'];
        $settore = $risultato['settore'];
        $durata = $risultato['durata'];

        $Ser = new EServizio($nome,$descrizione,$settore,$durata);

        $FSer->inserisciServizio($Ser);
        header('Location: ../../index.php');

    }

    private function modificaServizio() {

        $FSer = new FServizio();

        $VAdm = new VAdmin();
        $risultato = $VAdm->getModificaSer();

        $vecchioNome = $risultato['vecchioNome'];
        $nomeSer = $risultato['nomeSer'];
        $descSer = $risultato['descSer'];
        $settSer = $risultato['settSer'];
        $durataSer = $risultato['durataSer'];

        $vecchioSer = $FSer->caricaServizioDaDb($vecchioNome);

        $vecchioSer->setNomeServizio($nomeSer);
        $vecchioSer->setDescrizione($descSer);
        $vecchioSer->setSettore($settSer);
        $vecchioSer->setDurata($durataSer);

        $FSer->aggiornaServizio($vecchioSer);

        header('Location: ../../index.php');

    }

    private function modificaInfo() {

        $VAdm = new VAdmin();
        $campi = $VAdm->getModificaInfo();

        $titolo = $campi['titolo'];
        $sotto1 = $campi['sotto1'];
        $testo1 = $campi['testo1'];
        $sotto2 = $campi['sotto2'];
        $testo2 = $campi['testo2'];
        $sotto3 = $campi['sotto3'];
        $testo3 = $campi['testo3'];

        //se il file esiste già, prima lo cancello e in seguito lo riscrivo
        if(file_exists('contenutoStatico/informazioni.txt')) {
            unlink('contenutoStatico/informazioni.txt');
        }

        $UFile = new UFile();
        $file = $UFile->apriFile('../../contenutoStatico','informazioni.txt','w');

        $stringaDaScrivere =  $titolo."\n"
                             .$sotto1."\n"
                             .$testo1."\n"
                             .$sotto2."\n"
                             .$testo2."\n"
                             .$sotto3."\n"
                             .$testo3;

        $UFile->scriviFile($stringaDaScrivere,$file);
        $UFile->chiudiFile($file);

        header('Location: ../../index.php');

    }

    private function rimuoviServizio() {

        $FPro = new FProfessionista();

        $serviziDaRimuovere = $_REQUEST['serviziDaRimuovere'];
        $idProf = $_REQUEST['listaProfEliminaSer'];
        $FPro->rimuoviServiziOfferti($idProf, $serviziDaRimuovere);

        header('Location: ../../index.php');

    }

    private function assegnaServizio() {

        $FPro = new FProfessionista();

        $serviziDaAggiungere = $_REQUEST['serviziDaAggiungere'];
        $idProf = $_REQUEST['listaProfAggiungiSer'];
        $FPro->aggiungiServiziOfferti($idProf, $serviziDaAggiungere);

        header('Location: ../../index.php');
    }

// metodi che usano le chiamate ajax

    private function dettagliOrari() {
        $FPro = new FProfessionista();

        $risultato = array();

        $id = $_REQUEST['idOrario'];
        $prof = $FPro->caricaProfessionistaDaDB($id);
        $orari = $prof->getOrariLavorativi();

        $risultato['lun']=$orari['lun'];
        $risultato['mar']=$orari['mar'];
        $risultato['mer']=$orari['mer'];
        $risultato['gio']=$orari['gio'];
        $risultato['ven']=$orari['ven'];
        $risultato['sab']=$orari['sab'];
        $risultato['dom']=$orari['dom'];

        echo json_encode($risultato);
    }

    private function dettagliServizio() {
        $FSer = new FServizio();

        $risultato = array();

        $nome = $_REQUEST['nome'];
        $servizio = $FSer->caricaServizioDaDb($nome);
        $risultato['nomeSer'] = $servizio->getNomeServizio();
        $risultato['descSer'] = $servizio->getDescrizione();
        $risultato['settSer'] = $servizio->getSettore();
        $risultato['durataSer'] = $servizio->getDurata();

        echo json_encode($risultato);

    }

    /** AJAX:
     * Ritorna i servizi che un professionista ha tramite json
     */
    private function dettagliServiziProf() {
        $FPro = new FProfessionista();

        $idPro = $_REQUEST['idProf'];
        $servizi = $FPro->ricavaServiziOfferti($idPro);

        $risultato = array();
        foreach($servizi as $ser) {
            /* @var $ser EServizio */
            $servizio = array();
            $servizio['nomeSer'] = $ser->getNomeServizio();
            $servizio['descSer'] = $ser->getDescrizione();
            $servizio['settSer'] = $ser->getSettore();
            $servizio['durataSer'] = $ser->getDurata();
            array_push($risultato,$servizio);
        }

        echo json_encode($risultato);

    }

    private function dettagliAltriServiziProf() {

        $FPro = new FProfessionista();
        $FSer = new FServizio();

        $idPro = $_REQUEST['idProf'];
        $serviziPro = $FPro->ricavaServiziOfferti($idPro);
        $tuttiServ = $FSer->caricaServizi();

        $strServiziPro = array();
        $strTuttiSer = array();
        $diff = array();

        foreach($serviziPro as $serPro) {
            array_push($strServiziPro,$serPro->getNomeServizio());
        }
        foreach($tuttiServ as $serTut) {
            array_push($strTuttiSer,$serTut->getNomeServizio());
        }

        $strDiff = array_diff($strTuttiSer,$strServiziPro);
        foreach($strDiff as $valore) {
            $indice = array_search($valore,$strTuttiSer);
            array_push($diff,$tuttiServ[$indice]);
        }


        $risultato = array();
        foreach($diff as $ser) {
            /* @var $ser EServizio */
            $servizio = array();
            $servizio['nomeSer'] = $ser->getNomeServizio();
            array_push($risultato,$servizio);
        }

        echo json_encode($risultato);

    }

    private function dataItaToISO($data) {
        $arrayData=  explode("/", $data);

        $giorno=$arrayData[0];
        $mese=$arrayData[1];
        $anno=$arrayData[2];

        $dataISO= $anno."-".$mese."-".$giorno;
        return $dataISO;
    }
    
    private function errore($messaggioErrore)   {
        $sessione = new USession();
        $sessione->impostaValore('messaggioErrore', $messaggioErrore);
        header("location: ../../index.php");
    }


}