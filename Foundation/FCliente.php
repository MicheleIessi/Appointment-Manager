<?php
/**
 * FCliente gestisce gli scambi di informazioni con la tabella 'cliente'
 *
 * @package  Foundation
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */

class FCliente extends Fdb  {

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'appuntamento';
        $this->primary_key = 'IDC';
        $this->attributi = 'IDApp,IDP,IDC,data,orarioInizio,visita';
        $this->return_class = 'EAppuntamento';
        $this->bind = ':IDApp,:IDP,:IDC,:data,:orarioInizio,:visita';
        $this->bind_key = ':IDC';
        $this->old_keys;
    }

    /** La funzione aggiungiCliente aggiunge una ennupla alla tabella cliente
     * @param $id int L'id del cliente da aggiungere
     */
    public function aggiungiCliente($id) {
        $valori = array();
        $valori[':IDC'] = $id;
        parent::inserisciGenerica($valori,'cliente');
    }

    /** La funzione cancellaCliente elimina una ennupla dalla tabella 'cliente'
     * @param $id int L'id del cliente che si vuole eliminare dalla tabella
     * @return bool true se c'è stato un cancellamento, false altrimenti
     */
    public function cancellaCliente($id) {
        $FUte = new FUtente();
        $EUte = $FUte->caricaUtenteDaDb($id);
        $FUte->cancellaUtente($EUte);
        parent::setParam('cliente',$this->primary_key,$this->bind_key,$this->bind_key,$this->old_keys);
        $valori = array();
        $valori[':IDC'] = $id;
        if(parent::cancella($valori) == 0) { //non è stata cancellata nessuna ennupla da cliente
            return false;
        }
        else
            return true;
    }

    /** La funzione getAppuntamenti si occupa di prendere dal database lo storico degli appuntamenti di un cliente
     * @param $idc int L'id del cliente per il quale si vuole caricare la lista degli appuntamenti
     * @return array un array di oggetti EAppuntamento del cliente
     */
    public function getAppuntamenti($idc) {
        $this->setParametri();
        $valori[':IDC']=$idc;
        $risultato = array();
        if( sizeof($res =  parent::caricaConChiave($valori,'IDC')) != 0  ) {
            $FSer = new FServizio();
            foreach ($res as $appuntamento) {
                //Scompatto l'array $appuntamento, creo l'oggetto EServizio e metto tutto dentro $risultato
                $chiaveServizio = $appuntamento['visita'];
                $IDProf = $appuntamento['IDP'];
                $IDCliente = $appuntamento['IDC'];
                $dataApp = $appuntamento['data'];
                $orarioApp = $appuntamento['orarioInizio'];
                $servizio = $FSer->caricaServizioDaDb($chiaveServizio);

                $IDApp = $appuntamento['IDApp'];

                $app = new EAppuntamento($IDProf,$IDCliente,$dataApp,$orarioApp,$servizio,$IDApp);

                array_push($risultato, $app);
            }
        }
        return $risultato;
    }

    /** La funzione getAppuntamentiFuturi si occupa di trovare tutti gli appuntamenti non ancora avvenuti tra un dato
     * cliente e un dato professionista. Questa funzione sarà usata per verificare che un cliente non abbia più di 3
     * impegni futuri con un dato professionista.
     * @param $idc int L'id del cliente
     * @param $idp int L'id del professionista
     * @return array Un array di oggetti EAppuntamento, rappresentante gli appuntamenti futuri di un cliente con un professionista.
     */
    public function getAppuntamentiFuturi($idc,$idp) {
        $appuntamenti = $this->getAppuntamenti($idc);
        $appFuturi = array();
        foreach($appuntamenti as $app) {
            /* @var $app EAppuntamento */
            $id = $app->getIDProfessionista();
            $dataString = $app->getData()." ".$app->getOrario();
            $data = new DateTime($dataString);
            $orarioAttuale = new DateTime();
            if($data > $orarioAttuale && $id==$idp) {
                array_push($appFuturi,$app);
            }
        }
        return $appFuturi;
    }

    private function setParametri() {
        parent::setParam($this->table,$this->primary_key,$this->attributi,$this->bind_key,$this->old_keys);
    }
    
}
