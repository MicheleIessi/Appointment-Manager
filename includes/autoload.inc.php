<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function __autoload($class_name) {
    switch ($class_name[0]) {
        case 'P':
            require_once('Presentation/' . $class_name . '.php');
            break;
        case 'F':
            require_once('Foundation/' . $class_name . '.php');
            break;
        case 'E':
            require_once('Entity/' . $class_name . '.php');
            break;
        case 'C':
            require_once('Controller/' . $class_name . '.php');
            break;
        case 'U':
            require_once('Foundation/Utility/' . $class_name . '.php');

    }
}


