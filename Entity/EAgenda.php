<?php
class EAgenda {
    // Attributi
    private $impegni;        // è un array di EAppuntamento
    private $durataBlocco;      // in minuti, può essere 10, 20 30 o 60
    private $settimana;
    // Costruttore
    public function __construct($i=array(),$d) {
        $this->setImpegni($i);
        $this->setDurataBlocco($d);
        $this->setSettimanaLavorativa();
    }

    // Metodi
    public function setImpegni($i)  {
        foreach ($i as $appuntamenti) {
            if( !( is_a($appuntamenti, "EAppuntamento") ) )    {
                throw new Exception("Variabile non valida", 1);
            }
            $this->aggiungiAppuntamento($appuntamenti);
        }
    }

    public function setDurataBlocco($d) {       //ricontrollare
        if($d!=(10 or 20 or 30 or 60))    {
            throw new Exception('Durata non valida', 1);
        }
        $this->durataBlocco=$d;
    }

    public function setSettimanaLavorativa() {
        /*
        Nell'agenda ad ogni blocco può essere associata una delle seguenti stringhe:
        'D' (disponibile), 'O' (occupato), 'NA' (non disponibile). Un blocco 'L' può essere usato per
        l'inserimento di un appuntamento, un blocco 'O' è già occupato da un appuntamento,
        un blocco 'NA' non è disponibile in quanto fuori dall'orario di lavoro del professionista
        */

        $blocchi=(60/$this->durataBlocco)*24;
        $str = 'NA';

        $sett = array(
            'lun'=> array_fill(0,$blocchi,$str),
            'mar'=> array_fill(0,$blocchi,$str),
            'mer'=> array_fill(0,$blocchi,$str),
            'gio'=> array_fill(0,$blocchi,$str),
            'ven'=> array_fill(0,$blocchi,$str),
            'sab'=> array_fill(0,$blocchi,$str),
            'dom'=> array_fill(0,$blocchi,$str)
        );
        $this->settimana=$sett;
    }

    public function setOrari(array $a) {
        foreach($a as $giorno=>$orario) {
            $arr[$giorno] = explode(',',$orario);
            echo "$giorno:<br>";
            foreach($arr[$giorno] as $day) {
                if(is_string($day) && strlen($day)>0) {
                    $ora = explode('-', $day);
                    $orainizio = $ora[0];
                    $orafine = $ora[1];
                    echo "Orario d'inizio: $orainizio; orario finale: $orafine<br>";
                    //conversione:
                    $bloccoinizio = $this->convertiOraInBlocco($orainizio);
                    $bloccofine = $this->convertiOraInBlocco($orafine);
                    echo "Blocco d'inizio: $bloccoinizio; blocco finale: $bloccofine<br>";
                    for ($i = $bloccoinizio; $i < $bloccofine; $i++) {
                        $this->settimana[$giorno][$i] = 'D';
                    }
                }
            }
        }
    }
    //ora è in forma hh:mm
    private function convertiOraInBlocco($ora) {
        $arrayOra=explode(':',$ora);
        $bloccoOra=($arrayOra[0]*60)/$this->durataBlocco;
        $bloccoMinuti=($arrayOra[1]/$this->durataBlocco);
        $blocco=$bloccoOra+$bloccoMinuti;
        return $blocco;
    }












    public function getImpegni()    {
        return $this->impegni;
    }

    public function getDurataBlocco()   {
        return $this->durataBlocco;
    }

    public function getSettimana()  {
        return $this->settimana;
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