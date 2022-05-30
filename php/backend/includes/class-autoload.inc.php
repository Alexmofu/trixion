<?php

spl_autoload_register('autoloader');

function autoloader($className){
    $path = '/php/backend/classes/';
    $extension = '.class.php';
    $fullPath = $path . $className . $extension;

    $fullPath = $_SERVER["DOCUMENT_ROOT"].$fullPath;
    if(!file_exists($fullPath)){
        return false;
    }

    include_once $fullPath;
}

?>