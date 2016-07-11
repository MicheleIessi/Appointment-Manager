<?php

/**
 * FProfessionista si occupa di gestire gli scambi di informazioni con la tabella professionista.
 *
 * @package  Foundation
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */

class FProfessionista extends Fdb {

    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table='professionista';
        $this->primary_key='IDP';
        $this->attributi='IDP,settore,orarioLun,orarioMar,orarioMer,orarioGio,orarioVen,orarioSab,orarioDom';
        $this->return_class='EProfessionista';
        $this->bind=':IDP,:settore,:orarioLun,:orarioMar,:orarioMer,:orarioGio,:orarioVen,:orarioSab,:orarioDom';
        $this->bind_key=':IDP';
        $this->old_keys;
    }
    /** Il metodo inserisciProfessionista cerca di inserire un oggetto della classe EProfessionista nel Database.
     * Se il professionista non è già presente nel database come utente, provvede ad aggiungerlo. Inoltre, aggiunge
     * qualsiasi Servizio che il professionista offre nel database (se non già presente) e provvede al join tra
     * l'id del professionista e il nome del servizio nella tabella serviziOfferti.
     * @param EProfessionista $pro Il professionista da inserire
     * @throws Exception Se il professionista è già presente nel database.
     */
    public function inserisciProfessionista(EProfessionista $pro) {
        $ute = $pro->getUtenteDaProfessionista();
        $fute = new FUtente();
        $ute2 = $fute->caricaUtenteDaLogin($ute->getEmail(),$ute->getPassword()); # cerco di trovare l'utente corrispondente al professionista che si vuole inserire
        if(!$ute2) {
            # l'utente non è già nel db
            $fute->inserisciUtente($ute);
        }
        $id = $fute->caricaUtenteDaLogin($ute->getEmail(),$ute->getPassword())->getID();
        $pro->setID($id);
        $this->setParametri();
        $valori = parent::cambiaChiaviArray($pro->getArrayAttributi());
        try {
            if(parent::inserisci($valori) == 0) {
                throw new PDOException("Professionista già presente nel Database.<br>");
            }
            else {
                //echo("Professionista aggiunto correttamente al database.<br>");
                $servizi = $pro->getServiziOfferti();
                $fser = new FServizio();
                /** @var EServizio $servizio */
                foreach($servizi as $servizio) {
                    $fser->inserisciServizio($servizio);    //inserisco il servizio o non faccio nulla se è già presente
                    $nomeSer = $servizio->getNomeServizio();
                    $arrQuery = array();
                    $arrQuery[":IDP"] = $id;
                    $arrQuery[":nomeServizio"] = $nomeSer;
                    parent::inserisciGenerica($arrQuery,"serviziOfferti");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    /** Il metodo caricaProfessionistaDaDB crea un oggetto EProfessionista dopo aver effettuato una query di tipo select
     * nella tabella, prendendo come parametro l'id del professionista da cercare
     * @param $key int L'id del professionista
     * @return EProfessionista Il professionista con l'id scelto
     */
    public function caricaProfessionistaDaDB($key) {
        $fute = new FUtente();
        $utente = $fute->caricaUtenteDaDb($key);
        $valori = array();
        $valori[$this->bind_key] = $key;
        $this->setParametri();
        $risultato = parent::carica($valori);
        //risultato è un array del tipo IDP=>a,settore=>b,orari=>c
        $settore = $risultato['settore'];
        // a questo punto bisogna creare l'array associativo degli orari
        $orario=array();
        $orario['lun']=$risultato['orarioLun'];
        $orario['mar']=$risultato['orarioMar'];
        $orario['mer']=$risultato['orarioMer'];
        $orario['gio']=$risultato['orarioGio'];
        $orario['ven']=$risultato['orarioVen'];
        $orario['sab']=$risultato['orarioSab'];
        $orario['dom']=$risultato['orarioDom'];
        $serviziOfferti = $this->ricavaServiziOfferti($key);
        $codiceConferma = $utente->getCodiceConferma();
        $prof = new EProfessionista($utente->getNome(),$utente->getCognome(),$utente->getDataNascita(),
            $utente->getCodiceFiscale(),$utente->getSesso(),$utente->getEmail(),
            $utente->getPassword(),$codiceConferma,$key,$serviziOfferti,$settore,$orario);
        return $prof;
    }

    /** Il metodo aggiornaProfessionista cerca di modificare una ennupla della tabella professionista prendendo come
     * input un oggetto di tipo EProfessionista. L'oggetto di tipo EProfessionista passato come parametro deve avere
     * un id valido, cioè deve essere stato creato con l'id di un professionista conosciuto O creato tramite la
     * funzione caricaProfessionistaDaDB avente come parametro l'id del professionista.
     * @param EProfessionista $EPro
     */
    public function aggiornaProfessionista(EProfessionista $EPro) {

        if($EPro->getID()) {
            $id = $EPro->getID();
            $this->setParametri();
            $this->old_keys = $id;
            $valori = parent::cambiaChiaviArray($EPro->getArrayAttributi());

            if(parent::aggiorna($valori) != 0) {
                echo "Professionista con ID $id modificato correttamente.<br>";
            }
            else
                echo "Professionista con ID $id non esistente o impossibile da modificare.<br>";
        }
        else
            echo "Professionista non presente nel database.<br>";

    }
    /** Il metodo ricavaServiziOfferti prende come parametro un id e restituisce un array di oggetti EServizio, che
     * rappresenta una lista di servizi offerti dal professionista
     * @param $key string la chiave del professionista
     * @return array (EServizio) La lista di servizi offerti
     */
    public function ricavaServiziOfferti($key) {
        $valori = array();
        $valori[$this->bind_key] = $key;
        $result = parent::caricaGenerica($valori,"serviziOfferti","IDP");
        $arraySer = array();
        foreach($result as $servizio) {
            $fser = new FServizio();
            $ser = $fser->caricaServizioDaDb($servizio["nomeServizio"]);
            array_push($arraySer,$ser);
        }
        return $arraySer;
    }

    /** La funzione rimuoviServiziOfferti rimuove delle ennuple dalla tabella serviziOfferti se il professionista con id
     * selezionato li ha come servizi offerti. È il duale di aggiungiServiziOfferti.
     * @param $key int L'id del professionista per il quale si vogliono rimuovere servizi offerti
     * @param $servizi array(EServizio) Array di oggetti EServizio che si vogliono rimuovere dal pool di servizi offerti dal professionista.
     */
    public function rimuoviServiziOfferti($key,$servizi) {
        $FSer = new FServizio();
        $EPro = $this->caricaProfessionistaDaDB($key);
        $servProf = $EPro->getServiziOfferti();
        foreach($servizi as $servDaCanc) {
            $servizio = $FSer->caricaServizioDaDb($servDaCanc);
            parent::setParam('serviziofferti','IDP,nomeServizio',':IDP,:nomeServizio',':IDP,:nomeServizio',$this->old_keys);
            /* @var $servDaCanc EServizio */
            $valori = array();
            if(array_search($servizio,$servProf) !== false) {
                $EPro->rimuoviServizio($servizio);
                $valori[':IDP'] = $key;
                $valori[':nomeServizio'] = $servizio->getNomeServizio();
                parent::cancella($valori);
            }
            else
                echo "servizio non trovato!";
        }
        $this->setParametri();
    }

    /** La funzione aggiungiServiziOfferti aggiunge delle ennuple alla tabella serviziOfferti se il professionista con id
     * selezionato non li ha già come servizi offerti. È il duale di rimuoviServiziOfferti.
     * @param $key int L'id del professionista per il quale si vogliono aggiungere servizi offerti.
     * @param $servizi array(EServizi) Array di oggetti Eservizio che si vogliono aggiungere al pool di servizi offerti dal professionista.
     */
    public function aggiungiServiziOfferti($key, $servizi) {

        $FSer = new FServizio();
        $EPro = $this->caricaProfessionistaDaDB($key);
        $servProf = $EPro->getServiziOfferti();
        foreach($servizi as $servDaAgg) {
            $servizio = $FSer->caricaServizioDaDb($servDaAgg);
            $valori = array();
            if(array_search($servizio,$servProf) === false) {
                $EPro->aggiungiServizio($servizio);
                $valori[':IDP'] = $key;
                $valori[':nomeServizio'] = $servizio->getNomeServizio();
                parent::inserisciGenerica($valori,'serviziOfferti');
            }
            else
                echo "il professionista ha già questo servizio";
        }
    }

    /** La funzione caricaProfessionisti carica TUTTI i professionisti dal db e ritorna un array di oggetti EProfessionista
     * @return array(EProfessionista) Array di oggetti EProfessionista contenente tutti i professionisti presenti
     */
    public function caricaProfessionisti() {
        $result = parent::caricaTutte($this->table);
        $arrPro = array();
        foreach($result as $prof) {
            $profElem = $this->caricaProfessionistaDaDB($prof['IDP']);
            array_push($arrPro,$profElem);
        }
        return $arrPro;
    }

    private function setParametri() {
        $this->table='professionista';
        $this->primary_key='IDP';
        $this->attributi='IDP,settore,orarioLun,orarioMar,orarioMer,orarioGio,orarioVen,orarioSab,orarioDom';
        $this->bind=':IDP,:settore,:orarioLun,:orarioMar,:orarioMer,:orarioGio,:orarioVen,:orarioSab,:orarioDom';
        $this->bind_key=':IDP';
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }
}

