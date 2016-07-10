<?php

function myAutoload($class_name) {
    switch ($class_name[0]) {
        case 'V':
            require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/View/' . $class_name . '.php');
            break;
        case 'F':
            require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/Foundation/' . $class_name . '.php');
            break;
        case 'E':
            require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/Entity/' . $class_name . '.php');
            break;
        case 'C':
            require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/Control/' . $class_name . '.php');
            break;
        case 'U':
            require_once($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/Foundation/Utility/' . $class_name . '.php');
    }
}

spl_autoload_register('myAutoload');
