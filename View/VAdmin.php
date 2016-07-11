<?php
/**
 * VAdmin si occupa di gestire la visualizzazione della pagina dell'amministratore.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VAdmin extends View {

    /** La funzione impostaTemplate ritorna il template relativo alla pagina dell'amministratore dopo aver chiamato
     * metodi di supporto per popolare il template con dati utili.
     * @return resource Il template relativo alla pagina dell'amministratore.
     */
    public function impostaTemplate() {

        $this->setProfessionisti();
        $this->setServizi();
        return $this->fetch('paginaAmministratore.tpl');
    }

    /** La funzione getDatiAggiuntaProf viene chiamata quando l'amministratore tenta di aggiungere un professionista al
     * database tramite form. Raccoglie tutti i dati utili dalla variabile superglobale $_REQUEST e li inserisce in un
     * array che poi verrà usato dalla classe CAdmin.
     * @return array Array che racchiude il contenuto della form riempita dall'amministratore.
     */
    public function getDatiAggiuntaProf() {

        $risposta = array();
        $persona = array();

        $persona['nome'] = $_REQUEST['nome'];
        $persona['cognome'] = $_REQUEST['cognome'];
        $persona['dataNascita'] = $_REQUEST['dataNascita'];
        $persona['codiceFiscale'] = $_REQUEST['codiceFiscale'];
        $persona['sesso'] = $_REQUEST['sesso'];
        $persona['email'] = $_REQUEST['email'];
        $persona['pass1'] = $_REQUEST['password1'];
        $persona['pass2'] = $_REQUEST['password2'];
        $persona['sett'] = $_REQUEST['settore'];

        $risposta['persona'] = $persona;

        $orari = array();
        $orari['lun'] = $_REQUEST['orarioLun'];
        $orari['mar'] = $_REQUEST['orarioMar'];
        $orari['mer'] = $_REQUEST['orarioMer'];
        $orari['gio'] = $_REQUEST['orarioGio'];
        $orari['ven'] = $_REQUEST['orarioVen'];
        $orari['sab'] = $_REQUEST['orarioSab'];
        $orari['dom'] = $_REQUEST['orarioDom'];

        $risposta['orari'] = $orari;

        return $risposta;

    }

    /** La funzione getModificheOrari viene richiamata quando l'amministratore tenta di modificare gli orari di lavoro
     * di un professionista tramite form. Raccoglie tutti i dati utili dalla variabile superglobale $_REQUEST e li
     * inserisce in un array che verrà poi usato dalla classe CAdmin.
     * @return array Array che racchiude il contenuto della form riempita dall'amministratore.
     */
    public function getModificheOrari (){

        $risultato = array();

        $orari['lun'] = $_REQUEST['modOrarioLun'];
        $orari['mar'] = $_REQUEST['modOrarioMar'];
        $orari['mer'] = $_REQUEST['modOrarioMer'];
        $orari['gio'] = $_REQUEST['modOrarioGio'];
        $orari['ven'] = $_REQUEST['modOrarioVen'];
        $orari['sab'] = $_REQUEST['modOrarioSab'];
        $orari['dom'] = $_REQUEST['modOrarioDom'];
        $idProf       = $_REQUEST['listaProf'];
        $risultato['idProf'] = $idProf;
        $risultato['orari'] = $orari;
        return $risultato;
    }

    /** La funzione getInserimentoSer viene richiamata quando l'amministratore tenta di aggiungere un servizio al
     * database tramite form. Raccoglie tutti i dati utili dalla variabile superglobale $_REQUEST e li inserisce in un
     * array che verrà poi usato dalla classe CAdmin.
     * @return array Array che racchiude il contenuto della form riempita dall'amministratore.
     */
    public function getInserimentoSer() {

        $risultato = array();

        $nomeSer = $_REQUEST['nomAggSer'];
        $descSer = $_REQUEST['desAggSer'];
        $settSer = $_REQUEST['setAggSer'];
        $durSer  = $_REQUEST['durAggSer'];

        $risultato['nome'] = $nomeSer;
        $risultato['descrizione'] = $descSer;
        $risultato['settore'] = $settSer;
        $risultato['durata'] = $durSer;

        return $risultato;
    }

    /** La funzione getModificaSer viene richiamata quando l'amministratore tenta di modificare un servizio tramite
     * form. Raccoglie tutti i dati utili dalla variabile superglobale $_REQUEST e li inserisce in un array che verrà
     * poi usato dalla classe CAdmin.
     * @return array Array che racchiude il contenuto della form riempita dall'amministratore.
     */
    public function getModificaSer() {

        $risultato = array();

        $vecchioNomeSer = $_REQUEST['listaSer'];

        $nomeSer = $_REQUEST['nomeModSer'];
        $descSer = $_REQUEST['descModSer'];
        $settSer = $_REQUEST['settModSer'];
        $durataSer = $_REQUEST['durataModSer'];

        $risultato['vecchioNome'] = $vecchioNomeSer;
        $risultato['nomeSer'] = $nomeSer;
        $risultato['descSer'] = $descSer;
        $risultato['settSer'] = $settSer;
        $risultato['durataSer'] = $durataSer;

        return $risultato;
    }

    /** La funzione getModificaInfo viene richiamata quando l'amministratore tenta di modificare le informazioni
     * dell'azienda/sito tramite form. Raccoglie tutti i dati utili dalla variabile superglobale $_REQUEST e li
     * inserisce in un array che verrà poi usato dalla classe CAdmin.
     * @return array Array che racchiude il contenuto della form riempita dall'amministratore.
     */
    public function getModificaInfo() {

        $risultato = array();

        $titolo = ($_REQUEST['infoTitolo']  == "") ? "" : $_REQUEST['infoTitolo'];
        $sotto1 = ($_REQUEST['infoSot1']    == "") ? "" : $_REQUEST['infoSot1'];
        $testo1 = ($_REQUEST['testoArea1']  == "") ? "" : $_REQUEST['testoArea1'];
        $sotto2 = ($_REQUEST['infoSot2']    == "") ? "" : $_REQUEST['infoSot2'];
        $testo2 = ($_REQUEST['testoArea2']  == "") ? "" : $_REQUEST['testoArea2'];
        $sotto3 = ($_REQUEST['infoSot3']    == "") ? "" : $_REQUEST['infoSot3'];
        $testo3 = ($_REQUEST['testoArea3']  == "") ? "" : $_REQUEST['testoArea3'];

        $risultato['titolo'] = $titolo;
        $risultato['sotto1'] = $sotto1;
        $risultato['testo1'] = $testo1;
        $risultato['sotto2'] = $sotto2;
        $risultato['testo2'] = $testo2;
        $risultato['sotto3'] = $sotto3;
        $risultato['testo3'] = $testo3;

        return $risultato;
    }

    /**
     * La funzione setProfessionisti è una funzione di supporto il cui compito è popolare la variabile Smarty
     * 'professionisti' presente nel template di dati relativi ai professionisti presenti nel database.
     */
    public function setProfessionisti() {

        $FPro = new FProfessionista();
        $professionisti = $FPro->caricaProfessionisti();
        $profOptions = array();
        foreach($professionisti as $prof) {
            /* @var $prof EProfessionista */
            $profDaConvertire = array();
            $profDaConvertire['idProf'] = $prof->getID();
            $profDaConvertire['nomePro'] = $prof->getNome();
            $profDaConvertire['cognomePro'] = $prof->getCognome();
            array_push($profOptions,$profDaConvertire);
        }

        $this->setData('professionisti',$profOptions);

    }

    /**
     * La funzione setServizi è una funzione di supporto il cui compito è popolare la variabile Smarty
     * 'servizi' presente nel template di dati relativi ai servizi presenti nel database.
     */
    public function setServizi() {

        $FSer = new FServizio();
        $servizi = $FSer->caricaServizi();
        $servOptions = array();
        foreach($servizi as $serv) {
            /* @var $serv EServizio */
            $servDaConvertire = array();
            $servDaConvertire['nomeSer'] = $serv->getNomeServizio();
            array_push($servOptions,$servDaConvertire);
        }

        $this->setData('servizi',$servOptions);

    }


}