<?php
/**
* EAgenda e' una classe del package Entity
*
* EAgenda e' la classe invocata ogni volta che bisogna visualizzare lato view 
* l'agenda di un professionista 
*
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
*/
class EAgenda {
    // Attributi
    private $IDProfessionista;
    private $impegni = array();        // è un array di EAppuntamento

    //Costruttore
    public function __construct($i=array(),$id) {
        try {
            $this->setIDProfessionista($id);
            $this->setImpegni($i);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * la funzione setImpegni e' la funzione che si occupa di settare gli impegni
     * gia presi con altri clienti di un professionista. Prende come parametro
     * una array di oggetti EAppuntamento e controlla se ognuno di loro risulta
     * un oggetto EAppuntamento. Se p così lo aggiunge nell'array impegni mediante chiamata
     * della funzione aggiungiAppuntamento
     *
     * @param $i array(EAppuntamento) l'array di appuntamenti
     * @throws Exception Se uno degli oggetti nell'array non è un EAppuntamento
     */
    public function setImpegni($i) {
        foreach ($i as $appuntamenti) {
            if( !( is_a($appuntamenti, "EAppuntamento") ) )    {
                throw new Exception("Impossibile inserire nell'agenda un oggetto non di tipo EAppuntamento.<br>", 1);
            }
            $this->aggiungiAppuntamento($appuntamenti);
        }
    }

    /**
     * Imposta l'id del professionista 'proprietario' dell'agenda
     * @param $id int L'id che si vuole impostare
     */
    public function setIDProfessionista($id) {
        $this->IDProfessionista=$id;
    }

    /**
     * Ritorna l'array di impegni dell'agenda
     * @return array (EAppuntamento) Array di oggetti EAppuntamento
     */
    public function getImpegni() {
        return $this->impegni;
    }

    /**
     * La funzione aggiungiAppuntamento e' una sottofunzione di setImpegni
     * che aggiunge gli oggetti EAppuntamento che riceve come parametro
     * nell'array degli impegni.
     *
     * @param EAppuntamento $a L'oggetto EAppuntamento da inserire
     * @throws Exception
     */
    public function aggiungiAppuntamento($a)    {    // $a è un oggetto della classe EAppuntamento
        if( !( is_a($a, "EAppuntamento") ) )    {
            throw new Exception("Variabile non valida", 1);
        }
        array_push($this->impegni, $a);
    }

    /**
     * la funzione eliminaAppuntamento riceve come parametro
     * un oggetto appuntamento cui viene fatta controllare la sua esistenza
     * all'interno dell'array impegni e eliminato nel caso in cui si verifichi un match
     * @param EAppuntamento $a
     */
    public function eliminaAppuntamento($a) {           // ricontrollare
        unset($this->impegni[array_search($a, $this->impegni)]);
    }
}