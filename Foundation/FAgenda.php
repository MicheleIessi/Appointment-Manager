<?php

class FAgenda extends Fdb {

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table = 'appuntamento';
        $this->primary_key = 'IDP';
        $this->attributi = 'IDApp,IDP,IDC,data,orarioInizio,visita';
        $this->return_class = 'EAgenda';
        $this->bind = ':IDApp,:IDP,:IDC,:data,:orarioInizio,:visita';
        $this->bind_key = ':IDP';
        $this->old_keys;
    }

    /** Il metodo pubblico caricaAgenda crea un oggetto EAgenda prendendo come parametro un ID con il quale verrà
     * effettuata una chiamata al metodo caricaAppuntamentiProfessionista per trovare tutti gli impegni corrispondenti
     * all'id.
     * @param $idp int l'id del professionista
     * @return EAgenda l'agenda del professionista con id $idp
     */
    public function caricaAgenda($idp) {
        $appuntamenti = $this->caricaAppuntamentiProfessionista($idp);
        return new $this->return_class($appuntamenti,$idp);
    }

    /** Il metodo privato caricaAppuntamentiProfessionista viene chiamato da caricaAgenda per creare un array di oggetti
     * EAppuntamento rappresentanti l'insieme degli impegni di un professionista
     * @param $idp int l'id del professionista
     * @return array l'array di oggetti EAppuntamento
     */
    private function caricaAppuntamentiProfessionista($idp) {
        $this->setParametri();
        $valori[':IDP']=$idp;
        $risultato = array();
        if( sizeof($res =  parent::caricaConChiave($valori,'IDP')) != 0  ) {
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
        else {
            echo "Professionista con ID $idp non trovato.<br>";
        }
        return $risultato;
    }

    private function setParametri() {
        parent::setParam($this->table,$this->primary_key,$this->attributi,$this->bind_key,$this->old_keys);
    }


}
