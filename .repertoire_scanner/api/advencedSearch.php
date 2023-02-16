<?php

    require_once '../autoload.php';

    $ListingRepo = new RepertoireListingAdvenced(array(
        'node_modules',
        'vendor'
    ));

    if ( $ListingRepo->sendApi() ) {
        $ListingRepo->jsonFormatListing();
    } else {
        $ListingRepo->jsonFormatError('argument not valid');
    }