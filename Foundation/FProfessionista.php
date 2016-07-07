<?php
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
     * @param EProfessionista $pro
     * @throws Exception
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
        var_dump($valori);
        try {
            if(parent::inserisci($valori) == 0) {
                throw new PDOException("Professionista già presente nel Database.<br>");
            }
            else {
                echo("Professionista aggiunto correttamente al database.<br>");
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
    /**
     * @param $key
     * @return EProfessionista
     */
    public function caricaProfessionistaDaDB($key) {
        $fute = new FUtente();
        $utente = $fute->caricaUtenteDaDb($key);
        $this->setParametri();
        $valori = array();
        $valori[$this->bind_key] = $key;
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
    /** deve trovare tutti i servizi offerti da un professionista e restituire un array che li contiene
     * 1. query su serviziofferti con IDP come chiave x
     * 2. per ogni risultato trovato, query su servizi per prendere le altre informazioni x
     * 3. creo un oggetto EServizio ogni volta e lo metto in un array x
     * 4. ritorno l'array contenente gli oggetti EServizio rappresentanti i servizi offerti dal professionista x
     * @param $key string la chiave del professionista
     * @return mixed
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

    /** La funzione caricaProfessionisti carica TUTTI i professionisti dal db e ritorna un array di oggetti EProfessionista
     * @return array
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
        parent::setParam($this->table,$this->attributi,$this->bind,$this->bind_key,$this->old_keys);
    }
}

