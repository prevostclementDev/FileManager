<?php


    /* error_reporting(0); */
    require_once 'function/.repertoire.function.xml.php';
    
    require_once 'function/.repertoire.function.post.php';

    require_once '.repertoire.variable.php';

    require_once 'function/.repertoire.function.base.php';
    require_once 'function/.repertoire.function.acces.php';
    require_once 'function/.repertoire.function.get.php';
    require_once 'function/.repertoire.function.display.php';

    $list = listing_file($acces,$acces_serveur,$support_file,$AllListing);

    /* TODO AJAX CHARGEMENT PLUS STYLE */