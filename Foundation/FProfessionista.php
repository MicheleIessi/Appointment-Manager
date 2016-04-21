<?php
require('Fdb.php');
require('FUtente.php');
class FProfessionista extends Fdb {
    
    public function __construct() {
        if(!parent::isOn())
            parent::__construct();
        $this->table='professionisti';
        $this->primary_key='IDP';
        $this->attributi='IDP,settore,orari';
        $this->return_class='EProfessionista';
        $this->bind=':IDP,:settore,:orari';
        $this->bind_key=':IDP';
        $this->old_keys;
    }
    
    
    public function ConvertiUteProf(EUtente $U,$so,$set,$or)
    {$arr=$U->getArrayAttributi();
     $Ep=new EProfessionista($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],
             $arr[7],$so, $set, $or);
     return $Ep;
    }
    
    
    public function inserisciProfessionista(EProfessionista $pro) {

    }
    public function caricaProfessionistaDaDb($key){
        $Fu=new FUtente();
        $Eu=$Fu->caricaUtenteDaDb($key);
        $this->setParametri();
        $valori=explode(',',$key);
        $binding=explode(',',$this->bind_key);
        $i=0;
        $arr = array();
        foreach($valori as $str) {
            $arr["$binding[$i]"]=$str;
            $i++;
        }
        $arrayPro = parent::carica($arr);
        $arrayPro = array_values($arrayPro);
        
        $Pro=$this->ConvertiUteProf($Eu, $arrayPro[0],$arrayPro[1], $arrayPro[2]);
        echo "Professionista {$Pro->getNome()} {$Pro->getCognome()} caricato correttamente.<br>";
        return $Pro;
    }
    private function setParametri() {
        parent::setParam($this->table,$this->attributi,
                $this->bind,$this->bind_key,$this->old_keys);
    }
      
        
    }





    
    

