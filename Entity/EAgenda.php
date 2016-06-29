<?php
class EAgenda {
    // Attributi
    private $IDProfessionista;
    private $impegni = array();        // è un array di EAppuntamento


    public function __construct($i=array(),$id) {
        try {
            $this->setIDProfessionista($id);
            $this->setImpegni($i);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    // Metodi
    public function setImpegni($i) {
        foreach ($i as $appuntamenti) {
            if( !( is_a($appuntamenti, "EAppuntamento") ) )    {
                throw new Exception("Impossibile inserire nell'agenda un oggetto non di tipo EAppuntamento.<br>", 1);
            }
            $this->aggiungiAppuntamento($appuntamenti);
        }
    }

    public function setIDProfessionista($id) {
        $this->IDProfessionista=$id;
    }

    public function getImpegni() {
        return $this->impegni;
    }

    public function aggiungiAppuntamento($a)    {    // $a è un oggetto della classe EAppuntamento
        if( !( is_a($a, "EAppuntamento") ) )    {
            throw new Exception("Variabile non valida", 1);
        }
        array_push($this->impegni, $a);
    }

    public function eliminaAppuntamento($a) {           // ricontrollare
        unset($this->impegni[array_search($a, $this->impegni)]);
    }
}