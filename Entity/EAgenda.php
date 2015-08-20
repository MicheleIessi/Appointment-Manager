<?php

class EAgenda {
    
    // Attributi
    private $impegni;
    private $proprietario;
    
    // Costruttore
    public function __construct($i,$p) {
        $this->impegni=setImpegni($i);
        $this->proprietario=setProprietario($p);         //composizione
    }
    
    // Metodi
    public function setImpegni($i)  {   // $i è un array di oggetti della classe EAppuntamento
        foreach ($i as $appuntamenti) {     
            if( !( is_a($appuntamenti, EAppuntamento) ) )    {    
            throw new Exception("Variabile non valida", 1);
        }
    }
        $this->impegni=$i;
    }
    
    public function setProprietario($p) {
        if( !( is_a($p, EProfessionista) ) )    {    
            throw new Exception("Variabile non valida", 1);   
            }
        else    {
            $this->proprietario=$p;
        }
    }
    
    public function getImpegni()    {
        return $this->impegni;
        }
    
    public function getProprietario()   {
        return $this->proprietario;
    }
    
    public function aggiungiAppuntamento($a)    {
        if( !( is_a($a, EAppuntamento) ) )    {    
            throw new Exception("Variabile non valida", 1);
    }
    else {
        array_push($this->impegni, $a);     
        }
    }
    
    public function rimuoviAppuntamento($n) {
        unset($this->impegni[$n]);
        $temp=array_values($this->impegni);
        $this->impegni=$temp;
    }
    
    /* Servirebbe un metodo di classe per ordinare un array in base all'ordine cronologico degli orari degli
     * appuntamenti, poichè aggiungendo alla fine degli array gli elementi essi possono poi risultare 
     * sfasati. Il metodo di classe dovrebbe essere richiamato poi dalle funzioni che aggiungono-rimuovono 
     * elementi dall'array. L'uso di questa funzione consentirebbe inoltre di avere anche sul DB gli elementi 
     * in ordine e favorirebbe la loro immissione a livello grafico nell'agenda.
     */
    
}
