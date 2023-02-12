<?php

/**
 * @var $acces_preference
 */

    /* ALL LISTING */
    $AllListing = false; // If value is true it's possible they have performance bug and style bug

    /* ICONE FILE OR FOLDER */
    $support_file = array(
        "php"     => ".repertoire_scanner/images/icone/php.svg",
        "js"      => ".repertoire_scanner/images/icone/js.svg",
        "css"     => ".repertoire_scanner/images/icone/css.png",
        "scss"    => ".repertoire_scanner/images/icone/scss.png",
        "sass"    => ".repertoire_scanner/images/icone/scss.png",
        "xml"    => ".repertoire_scanner/images/icone/xml.png",
        "html"   => ".repertoire_scanner/images/icone/html.png",
        "default" => ".repertoire_scanner/images/icone/default.png",
        "folder"  => ".repertoire_scanner/images/icone/folder.png",
        "jpg"     => ".repertoire_scanner/images/icone/img.png",
        "jpeg"     => ".repertoire_scanner/images/icone/img.png",
        "png"     => ".repertoire_scanner/images/icone/img.png",
        "svg"     => ".repertoire_scanner/images/icone/img.png",
    );

    /* ACCES */

    $old_acces = "";
    $parent_get_url = "";
    $server = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']; // BASE SERVER URL

    $acces = $_SERVER['CONTEXT_DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']; // LOCAL ACCES
    $acces_serveur = $server.$_SERVER['REQUEST_URI']; // SERVEUR ACCES

