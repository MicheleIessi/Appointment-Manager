<?php
/**
 * VCalendar si occupa di gestire la visualizzazione dell'agenda di un professionista.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VCalendar extends View {
    /** La funzione processaTemplate ritorna il template relativo al calendario (l'agenda) di un dato professionista.
     * @return string Il template relativo al calendario di un professionista.
     */
    public function processaTemplate() {
        return $this->fetch('calendario_default.tpl');
    }

    /** La funzione getListaProfessionisti ritorna il template relativo alla lista di professionisti iscritti,
     * opportunamente popolato tramite le funzioni di Smarty.
     * @return string Il template relativo alla lista dei professionisti presenti.
     */
    public function getListaProfessionisti() {
        $FPro = new FProfessionista();
        $arrayProf = $FPro->caricaProfessionisti();
        $arrayLink = $this->getArrayPerLink($arrayProf);
        $this->setData('prof',$arrayLink);
        return $this->fetch('listaProfessionisti.tpl');
    }

    /** La funzione getColonnaServizi ritorna il template relativo alla colonna a destra dell'agenda nel caso in cui
     * sia un utente a richiedere la visualizzazione dell'agenda di un professionista. In questo caso sono presenti
     * nel template i servizi offerti dal professionista a cui appartiene l'agenda che si sta guardando.
     * @return string Il template relativo alla colonna dei servizi - caso cliente
     */
    public function getColonnaServizi() {

        return $this->fetch('colonna_servizi.tpl');
    }

    /** La funzione getColonnaProfessionista ritorna il template relativo alla colonna a destra dell'agenda nel caso in
     * cui un professionista richieda di visualizzare il proprio calendario. In questo caso sono presenti i div che
     * permettono la cancellazione di appuntamenti da parte del professionista.
     * @return string Il template relativo alla colonna dei servizi - caso professionista proprietario
     */
    public function getColonnaProfessionista() {
        return $this->fetch('colonnaCancellazione.tpl');
    }

    /** La funzione getColonnaInformazioni ritorna il template relativo alla colonna a destra dell'agenda nel caso in
     * cui un professionista richieda di visualizzare un calendario non suo. In questo caso non sono presenti i div che
     * permettono la cancellazione di appuntamenti, è presente solo una breve descrizione dell'agenda.
     * @return string Il template relativo alla colonna dei servizi - caso professionista non proprietario
     */
    public function getColonnaInformazioni() {
        return $this->fetch('colonnaInformazioni.tpl');
    }

    /** La funzione getArrayPerLink è una funzione di supporto usata da getListaProfessionisti al fine di passare al
     * template dati opportunamente formattati all'interno di un array, per permettere la creazione di link dinamici
     * in base ai professionisti presenti nel database.
     * @param $arrayProf array Array di oggetti EProfessionista presenti nel database
     * @return array Array ri-elaborato contenente id, nome e cognome dei professionisti per la creazione dei link
     */
    private function getArrayPerLink($arrayProf) {

        $arrayLink = array();
        foreach($arrayProf as $professionista) {
            $profLink = array();
            $profLink['id'] = $professionista->getID();
            $profLink['nome'] = $professionista->getNome();
            $profLink['cognome'] = $professionista->getCognome();
            array_push($arrayLink,$profLink);
        }
        return $arrayLink;
    }

}