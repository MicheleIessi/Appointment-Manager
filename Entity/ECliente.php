<?php
/**
* ECliente e' una classe del package Entity
*
* ECliente e' la classe invocatata nel momento in cui bisogna definire
* un nuovo cliente associato alla creazione di un appuntamento tra un utente ed un 
* professionista 
* 
* @package  Entity
* @author   Michele Iessi
* @author   Davide Iessi
* @author   Andrea Pagliaro
* @access   public
 */

class ECliente {
    
    //Costruttore
    public function __construct($n, $c, $dn, $cf, $s, $e, $p) {
        parent::__construct($n, $c, $dn, $cf, $s, $e, $p);
    }
}
