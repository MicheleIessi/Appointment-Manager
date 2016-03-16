<?php

/**
 * Created by PhpStorm.
 * User: Michele
 * Date: 16/03/2016
 * Time: 11:42
 */

/**
 * Class USingleton Assicura che ogni classe venga istanziata una sola volta
 */
class USingleton {

    private static $instances = array();

    private function __construct() {
        //nulla
    }

    /** Restituisce l'istanza univoca della classe
     * @param $class String La classe che si vuole istanziare
     */
    public static function getInstance($class) {
        if(!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }
}