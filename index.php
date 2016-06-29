<?php

    require_once('includes/autoload.inc.php');
    
    $arraySettimana= [
                        'lun' => "09:00-13:00,15:00-19:00",
                        'mar' => "09:00-13:00,15:00-19:00",
                        'mer' => "09:00-13:00,15:00-19:00",
                        'gio' => "11:00-13:00,15:00-17:00",
                        'ven' => "09:00-13:00,15:00-19:00",
                        'sab' => "15:00-19:00",
                        'dom' => ""    
                     ];
    
    $Agenda= new EAgenda(array(), 60);
    $Agenda->setOrari($arraySettimana);
    