<?php

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

    private function setParametri() {
        parent::setParam($this->table,$this->primary_key,$this->attributi,$this->bind_key,$this->old_keys);
    }
    
}
