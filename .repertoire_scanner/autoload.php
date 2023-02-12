<?php

    function loadAddons($className) {

        if (file_exists($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.repertoire_scanner/addons/'.$className.DIRECTORY_SEPARATOR.$className.".php")) {
            require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.repertoire_scanner/addons/'.$className.DIRECTORY_SEPARATOR.$className.".php";
        }

    }

    function loadAttributClass($classname) {

        if ( file_exists($_SERVER['DOCUMENT_ROOT'].'.repertoire_scanner/attributClass/'.$classname.'.php') ) {
            require_once $_SERVER['DOCUMENT_ROOT'].'.repertoire_scanner/attributClass/'.$classname.'.php';
        }

    }

    function loadFunction($classname) {

        if ( file_exists($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.repertoire_scanner/function/'.$classname.".php") ) {
            require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.repertoire_scanner/function/'.$classname.".php";
        }

    }


    spl_autoload_register('loadAddons');
    spl_autoload_register('loadAttributClass');
    spl_autoload_register('loadFunction');
